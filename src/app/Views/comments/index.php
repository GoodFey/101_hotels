<?php
$this->extend('layout');
$this->section('content');
?>

<style>
    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    #nameError {
        animation: slideDown 0.2s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">💬 Комментарии</h1>

    <!-- Панель сортировки -->
    <div class="card mb-4 border-light">
        <div class="card-body">
            <div class="row g-2 align-items-end">
                <div class="col-auto">
                    <label for="sortBy" class="form-label small mb-1">Сортировать по:</label>
                    <select id="sortBy" class="form-select form-select-sm">
                        <option value="id" <?= $sortBy === 'id' ? 'selected' : '' ?>>ID</option>
                        <option value="date" <?= $sortBy === 'date' ? 'selected' : '' ?>>Дате добавления</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="sortDir" class="form-label small mb-1">Направление:</label>
                    <select id="sortDir" class="form-select form-select-sm">
                        <option value="DESC" <?= $sortDir === 'DESC' ? 'selected' : '' ?>>По убыванию</option>
                        <option value="ASC" <?= $sortDir === 'ASC' ? 'selected' : '' ?>>По возрастанию</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Список комментариев -->
    <div id="commentsContainer">
        <?php echo view('comments/list', [
            'comments' => $comments,
            'pager' => $pager,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalComments' => $totalComments,
            'sortBy' => $sortBy,
            'sortDir' => $sortDir
        ]); ?>
    </div>

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
                        type="text"
                        class="form-control"
                        id="name" 
                        name="name" 
                        placeholder="your@email.com"
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
                    ></textarea>
                    <small class="text-danger d-block mt-1" id="textError"></small>
                </div>


                <button type="submit" class="btn btn-primary btn-block w-100">
                    ✅ Отправить комментарий
                </button>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

