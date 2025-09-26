<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['susername'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        $error = "Пользователь с таким именем или email уже существует.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Регистрация</h2>
            </div>
            
            <div class="content">
                <?php if (isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Имя:</label>
                        <input type="text" id="username" name="susername" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn">Зарегистрироваться</button>
                    </div>
                </form>
                
                <div class="text-center mt-20">
                    <a href="login.php" class="btn btn-secondary">Уже есть аккаунт?</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>