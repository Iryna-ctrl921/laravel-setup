<?php
require_once 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);
            
            $message = "<p style='color: green;'>Реєстрація успішна! <a href='login.php'>Увійти</a></p>";
        } catch (\PDOException $e) {
            $message = "<p style='color: red;'>Помилка: Користувач з таким ім'ям або поштою вже існує.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Заповніть усі поля!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>
<body>
    <h2>Форма реєстрації</h2>
    <?= $message; ?>
    <form action="register.php" method="POST">
        <label>Ім'я користувача:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Електронна пошта:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Пароль:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Зареєструватися">
    </form>
    <p>Вже є акаунт? <a href="login.php">Увійти</a></p>
</body>
</html>