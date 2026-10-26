<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна сторінка</title>
</head>
<body>
    <h2>Вітаємо, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Це захищена сторінка, доступна лише після успішної авторизації.</p>
    
    <br>
    <a href="logout.php">Вийти з акаунта (Logout)</a>
</body>
</html>