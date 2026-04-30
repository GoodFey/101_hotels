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

<?php if ($pager): ?>
    <nav aria-label="Page navigation" class="mb-4">
        <?= $pager->links('comments', 'default_full') ?>
    </nav>
<?php endif; ?>
