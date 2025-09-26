<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    try {
        if ($password) {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([$username, $email, $password, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            $stmt->execute([$username, $email, $user_id]);
        }

        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['email'] = $email;
        $success = "Данные обновлены!";
    } catch (PDOException $e) {
        $error = "Ошибка: имя или email уже заняты.";
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Личный кабинет</h2>
            </div>
            
            <div class="content">
                <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                <?php if (isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>

                <form method="POST">
                    <div class="form-group">
                        <label for="username">Имя:</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Новый пароль (оставьте пустым, чтобы не менять):</label>
                        <input type="password" id="password" name="password">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn">Сохранить</button>
                    </div>
                </form>

                <div class="text-center mt-20">
                    <a href="index.php" class="btn btn-secondary">Назад на форум</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>