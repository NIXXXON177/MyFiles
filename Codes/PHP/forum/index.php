<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Форум</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Форум</h1>
            </div>
            
            <div class="user-info">
                <p>Привет, <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>!</p>
                <div class="nav-links">
                    <a href="profile.php">Личный кабинет</a>
                    <?php if ($_SESSION['user']['is_admin']): ?>
                        <a href="admin.php">🛠️ Админ-панель</a>
                    <?php endif; ?>
                    <a href="logout.php">Выход</a>
                </div>
            </div>

            <div class="content">
                <div class="text-center mb-20">
                    <a href="create_post.php" class="btn">➕ Создать пост</a>
                </div>

                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                        <div class="post-content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>
                        <div class="post-meta">
                            <div>
                                <span class="post-author"><?= htmlspecialchars($post['username']) ?></span>
                                <span class="post-date"><?= $post['created_at'] ?></span>
                            </div>
                            <?php if ($_SESSION['user']['id'] == $post['user_id'] || $_SESSION['user']['is_admin']): ?>
                                <div class="post-actions">
                                    <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Удалить?')">🗑️ Удалить</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>