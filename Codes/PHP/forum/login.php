<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'is_admin' => (bool)$user['is_admin']
        ];
        header('Location: index.php');
        exit;
    } else {
        $error = "Неверный email или пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Вход</h2>
            </div>
            
            <div class="content">
                <?php if (isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn">Войти</button>
                    </div>
                </form>
                
                <div class="text-center mt-20">
                    <a href="register.php" class="btn btn-secondary">Регистрация</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>