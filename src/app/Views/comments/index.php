<?php
$this->extend('layout');
$this->section('content');
?>

<h1>Comments</h1>

<!-- Панель сортировки -->
<div class="sort-panel">
    <div class="row g-2 align-items-end">
        <div class="col-12 col-sm-auto">
            <label for="sortBy" class="form-label">Sort by:</label>
            <select id="sortBy" class="form-select form-select-sm w-100">
                <option value="id" <?= $sortBy === 'id' ? 'selected' : '' ?>>ID</option>
                <option value="date" <?= $sortBy === 'date' ? 'selected' : '' ?>>Date</option>
            </select>
        </div>
        <div class="col-12 col-sm-auto">
            <label for="sortDir" class="form-label">Direction:</label>
            <select id="sortDir" class="form-select form-select-sm w-100">
                <option value="DESC" <?= $sortDir === 'DESC' ? 'selected' : '' ?>>Descending</option>
                <option value="ASC" <?= $sortDir === 'ASC' ? 'selected' : '' ?>>Ascending</option>
            </select>
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
    <div class="card-header">
        <h5>Add Comment</h5>
    </div>
    <div class="card-body">
        <form id="commentForm">
            <div class="mb-3">
                <label for="name" class="form-label">Email <span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="your@email.com"
                >
                <small id="nameError"></small>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Comment <span class="text-danger">*</span></label>
                <textarea
                    class="form-control"
                    id="text"
                    name="text"
                    rows="4"
                    placeholder="Type your comment..."
                ></textarea>
                <small id="textError"></small>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Send Comment
            </button>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>

