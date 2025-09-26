<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск пользователя</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .result { margin-top: 20px; padding: 10px; background: #f0f0f0; border: 1px solid #ccc; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Поиск пользователя по ID</h2>

    <form method="GET" action="">
        <label for="user_id">Введите ID пользователя:</label>
        <input type="number" name="user_id" id="user_id" min="1" value="<?= htmlspecialchars($_GET['user_id'] ?? '') ?>">
        <button type="submit">Найти</button>
    </form>

    <hr>


    <?php
    if (isset($_GET['user_id'])) {
        $userId = (int)$_GET['user_id']; 

        if ($userId <= 0) {
            echo "<p class='error'>❌ Некорректный ID.</p>";
        } else {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=test_db;charset=utf8", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = ?");
                $stmt->execute([$userId]);

                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                  if ($user) {
                    echo "<div class='result success'>";
                    echo "<h3>✅ Найден пользователь:</h3>";
                    echo "<p><strong>ID:</strong> " . htmlspecialchars($user['id']) . "</p>";
                    echo "<p><strong>Имя:</strong> " . htmlspecialchars($user['name']) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
                    echo "</div>";
                } else {
                    echo "<p class='error'>❌ Пользователь с ID=$userId не найден.</p>";
                }
            } catch (PDOException $e) {
                echo "<p class='error'>❌ Ошибка подключения к БД: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
    } else {
        echo "<p>Введите ID пользователя и нажмите <strong>Найти</strong>.</p>";
    }
    ?>
</body>
</html>