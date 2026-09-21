<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset(); // Очищає всі змінні сесії
    session_destroy(); // Знищує саму сесію
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if ($login === 'admin' && $password === '1234') {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $login;
        header("Location: index.php");
        exit;
    } else {
        $error = "Невірний логін або пароль!";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Завдання 2: Session</title></head>
<body>
    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
        <h2>Вітаємо в системі, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <a href="?action=logout"><button>Вихід</button></a>
    <?php else: ?>
        <h2>Вхід в систему</h2>
        <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
        <form method="POST">
            <input type="text" name="login" required placeholder="Логін (admin)"><br><br>
            <input type="password" name="password" required placeholder="Пароль (1234)"><br><br>
            <button type="submit">Увійти</button>
        </form>
    <?php endif; ?>
</body>
</html>