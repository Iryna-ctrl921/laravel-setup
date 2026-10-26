<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS users_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<p style='color: green;'>Базу даних <b>users_db</b> успішно створено (або вона вже існувала).</p>";

    $pdo->exec("USE users_db");

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);
    echo "<p style='color: green;'>Таблицю <b>users</b> успішно створено.</p>";

    echo "<hr>";
    echo "<h3>БД та таблиця готові до роботи!</h3>";
    echo "<p><a href='register.php'>Перейти до форми реєстрації</a> | <a href='login.php'>Перейти до форми входу</a></p>";

} catch (PDOException $e) {
    echo "<p style='color: red;'><b>Помилка під час створення бази даних:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>