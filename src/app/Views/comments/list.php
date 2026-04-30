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

<?php if (isset($totalPages) && $totalPages > 1): ?>
    <nav aria-label="Page navigation" class="mb-4">
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <div class="text-muted small align-self-center">
                Страница <span class="fw-bold"><?= $currentPage ?></span> из
                <span class="fw-bold"><?= $totalPages ?></span>
            </div>
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <button class="page-link pagination-btn" data-page="1" <?= $currentPage == 1 ? 'disabled' : '' ?>>« Первая</button>
                </li>
                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <button class="page-link pagination-btn" data-page="<?= max(1, $currentPage - 1) ?>" <?= $currentPage == 1 ? 'disabled' : '' ?>>‹ Назад</button>
                </li>
                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                    <button class="page-link pagination-btn" data-page="<?= min($totalPages, $currentPage + 1) ?>" <?= $currentPage == $totalPages ? 'disabled' : '' ?>>Вперед ›</button>
                </li>
                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                    <button class="page-link pagination-btn" data-page="<?= $totalPages ?>" <?= $currentPage == $totalPages ? 'disabled' : '' ?>>Последняя »</button>
                </li>
            </ul>
        </div>
    </nav>
<?php endif; ?>
