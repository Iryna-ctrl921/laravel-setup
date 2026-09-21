<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Інформація про сервер</title></head>
<body>
    <h2>Дані з масиву $_SERVER:</h2>
    <ul>
        <li><strong>IP-адреса клієнта:</strong> <?= $_SERVER['REMOTE_ADDR'] ?></li>
        <li><strong>Назва та версія браузера:</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?></li>
        <li><strong>Назва скрипта:</strong> <?= $_SERVER['PHP_SELF'] ?></li>
        <li><strong>Метод запиту:</strong> <?= $_SERVER['REQUEST_METHOD'] ?></li>
        <li><strong>Шлях до файлу на сервері:</strong> <?= $_SERVER['SCRIPT_FILENAME'] ?></li>
    </ul>
    <a href="index.php">Повернутися назад</a>
</body>
</html>