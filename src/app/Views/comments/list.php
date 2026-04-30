<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <div class="card comment-item" data-id="<?= $comment['id'] ?>">
            <div class="card-body">
                <div class="d-flex justify-content-space-between align-items-center mb-2">
                    <h5 class="card-title mb-0">
                        <span class="text-muted">#<?= $comment['id'] ?></span>
                        <?= htmlspecialchars($comment['name']) ?>
                    </h5>
                </div>
                <p class="card-text"><?= htmlspecialchars($comment['text']) ?></p>
                <div class="comment-meta">
                    <span class="comment-date">
                        <?= $comment['date'] ?>
                    </span>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $comment['id'] ?>">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-info">
        No comments yet. Be the first!
    </div>
<?php endif; ?>

<?php if (isset($totalPages) && $totalPages > 1): ?>
    <nav aria-label="Page navigation" class="mb-4">
        <div class="pagination-info">
            Page <span class="fw-bold"><?= $currentPage ?></span> of <span class="fw-bold"><?= $totalPages ?></span>
            (total: <span class="fw-bold"><?= $totalComments ?></span>)
        </div>
        <div class="pagination">
            <button class="pagination-btn" data-page="1" <?= $currentPage == 1 ? 'disabled' : '' ?>>First</button>
            <button class="pagination-btn" data-page="<?= max(1, $currentPage - 1) ?>" <?= $currentPage == 1 ? 'disabled' : '' ?>>Prev</button>
            <button class="pagination-btn" data-page="<?= min($totalPages, $currentPage + 1) ?>" <?= $currentPage == $totalPages ? 'disabled' : '' ?>>Next</button>
            <button class="pagination-btn" data-page="<?= $totalPages ?>" <?= $currentPage == $totalPages ? 'disabled' : '' ?>>Last</button>
        </div>
    </nav>
<?php endif; ?>
