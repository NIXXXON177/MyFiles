<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>🛠️ Админ-панель</h1>
            </div>
            
            <div class="content">
                <div class="nav-links">
                    <a href="index.php">← Назад на форум</a>
                </div>

                <h2>Все пользователи</h2>
                <table class="admin-table">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Админ</th>
                        <th>Действия</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['is_admin'] ? '✅' : '❌' ?></td>
                        <td>
                            <?php if ($user['id'] != $_SESSION['user']['id']): ?>
                                <a href="?action=toggle_admin&id=<?= $user['id'] ?>"><?= $user['is_admin'] ? 'Убрать админа' : 'Сделать админом' ?></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] === 'toggle_admin' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $current = $stmt->fetch();

        $new_status = $current['is_admin'] ? 0 : 1;
        $stmt = $pdo->prepare("UPDATE users SET is_admin = ? WHERE id = ?");
        $stmt->execute([$new_status, $id]);

        header('Location: admin.php');
        exit;
    }
    ?>
</body>
</html>