<?php
$this->extend('layout');
$this->section('content');
?>

<div class="container mt-5">
    <h1 class="mb-4">💬 Комментарии</h1>

    <!-- Список комментариев -->
    <div class="comments-list mb-4" id="commentsList">
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="card mb-3 comment-item" data-id="<?= $comment['id'] ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-envelope"></i> <?= htmlspecialchars($comment['name']) ?>
                        </h5>
                        <p class="card-text"><?= htmlspecialchars($comment['text']) ?></p>
                        <small class="text-muted d-block mb-2">
                            📅 <?= $comment['date'] ?>
                        </small>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $comment['id'] ?>">
                            🗑️ Удалить
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                ℹ️ Комментариев еще нет. Будьте первым!
            </div>
        <?php endif; ?>
    </div>

    <!-- Пагинация -->
    <?php if ($pager): ?>
        <nav aria-label="Page navigation" class="mb-4">
            <?= $pager->links('comments', 'default_full') ?>
        </nav>
    <?php endif; ?>

    <!-- Форма добавления комментария -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">✏️ Добавить комментарий</h5>
        </div>
        <div class="card-body">
            <form id="commentForm">
                <div class="form-group mb-3">
                    <label for="name">Email <span class="text-danger">*</span></label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        placeholder="your@email.com"
                        required
                    >
                    <small class="text-danger d-block mt-1" id="nameError"></small>
                </div>

                <div class="form-group mb-3">
                    <label for="text">Текст комментария <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control" 
                        id="text" 
                        name="text" 
                        rows="4"
                        placeholder="Введите ваш комментарий..."
                        required
                    ></textarea>
                    <small class="text-danger d-block mt-1" id="textError"></small>
                </div>

                <div class="form-group mb-3">
                    <label for="date">Дата <span class="text-danger">*</span></label>
                    <input 
                        type="date" 
                        class="form-control" 
                        id="date" 
                        name="date"
                        required
                    >
                    <small class="text-danger d-block mt-1" id="dateError"></small>
                </div>

                <button type="submit" class="btn btn-primary btn-block w-100">
                    ✅ Отправить комментарий
                </button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Установка текущей даты по умолчанию
    const today = new Date().toISOString().split('T')[0];
    $('#date').val(today);

    // Отправка формы
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();
        
        // Очищаем ошибки
        $('.text-danger').text('');
        
        const formData = {
            name: $('#name').val(),
            text: $('#text').val(),
            date: $('#date').val()
        };

        $.ajax({
            url: '/comments',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#commentForm')[0].reset();
                    $('#date').val(today);
                    
                    // Показываем сообщение об успехе
                    const alert = $(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ✅ ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    $('#commentForm').before(alert);
                    
                    // Перезагружаем комментарии через 1 сек
                    setTimeout(() => location.reload(), 1000);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (response && response.errors) {
                    // Показываем ошибки валидации
                    $.each(response.errors, function(key, value) {
                        $(`#${key}Error`).text(value);
                    });
                }
            }
        });
    });

    // Удаление комментария
    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Вы уверены?')) return;
        
        const id = $(this).data('id');
        const $item = $(this).closest('.comment-item');
        
        $.ajax({
            url: `/comments/${id}`,
            type: 'DELETE',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $item.fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            }
        });
    });
});
</script>

<?php $this->endSection(); ?>

