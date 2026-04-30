<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?? 'Комментарии' ?></title>
    
    <!-- Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Main Styles -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="main-container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 1.5rem;">
            <a class="navbar-brand" href="/">
                Comments
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/comments">Comments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- jQuery 3 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 JS (для navbar toggler) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Comments JS -->
    <script src="/js/comments.js"></script>
</body>
</html>

