<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user']['id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $content]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Создать пост</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Создать пост</h2>
            </div>
            
            <div class="content">
                <form method="POST">
                    <div class="form-group">
                        <label for="title">Заголовок:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Содержание:</label>
                        <textarea id="content" name="content" rows="5" required></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn">Опубликовать</button>
                    </div>
                </form>
                
                <div class="text-center mt-20">
                    <a href="index.php" class="btn btn-secondary">Назад</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>