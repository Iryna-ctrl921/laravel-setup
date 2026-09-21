<?php
if (isset($_POST['delete_cookie'])) {
    setcookie("username", "", time() - 3600, "/");
    header("Location: index.php"); 
    exit;
}

if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
    $name = trim($_POST['username']);
    setcookie("username", $name, time() + (7 * 24 * 60 * 60), "/");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Завдання 1: Cookie</title></head>
<body>
    <?php if (isset($_COOKIE['username'])): ?>
        <h2>Привіт, <?= htmlspecialchars($_COOKIE['username']) ?>! З поверненням!</h2>
        <form method="POST">
            <button type="submit" name="delete_cookie">Видалити cookie (Забути мене)</button>
        </form>
    <?php else: ?>
        <h2>Введіть ваше ім'я:</h2>
        <form method="POST">
            <input type="text" name="username" required placeholder="Ваше ім'я">
            <button type="submit">Зберегти</button>
        </form>
    <?php endif; ?>
</body>
</html>