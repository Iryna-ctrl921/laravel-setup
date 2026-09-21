<?php
session_start();

$timeout_duration = 300; 
$message = "";

if (isset($_SESSION['user_logged_in'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        // Якщо час минув
        session_unset();
        session_destroy();
        $message = "Ваша сесія завершилась через неактивність (більше 5 хвилин). Увійдіть знову.";
    } else {
        $_SESSION['last_activity'] = time();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['last_activity'] = time();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="UTF-8"><title>Завдання 5: Тайм-аут сесії</title></head>
<body>
    <?php if (!empty($message)): ?>
        <p style="color:red;"><b><?= $message ?></b></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_logged_in'])): ?>
        <h2>Ви в системі!</h2>
        <p>Час останньої активності оновлено. Почекайте 5 хвилин і оновіть сторінку, щоб побачити завершення сесії.</p>
        <p>Поточний час на сервері: <?= date('H:i:s') ?></p>
        <p>Час останньої активності: <?= date('H:i:s', $_SESSION['last_activity']) ?></p>
        <form method="POST">
            <button type="submit" name="refresh">Оновити активність</button>
        </form>
    <?php else: ?>
        <h2>Вхід (Тест тайм-ауту)</h2>
        <form method="POST">
            <button type="submit" name="login">Увійти та розпочати сесію</button>
        </form>
    <?php endif; ?>
</body>
</html>