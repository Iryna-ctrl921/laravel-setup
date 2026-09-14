<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST["firstName"] ?? '');
    $lastName = trim($_POST["lastName"] ?? '');

    if (empty($firstName) || empty($lastName)) {
        echo "Помилка: Усі поля мають бути заповнені.";
    } 

    elseif (!preg_match("/^[a-zA-Zа-яА-ЯіІїЇєЄґҐ\'\s\-]+$/u", $firstName) || 
            !preg_match("/^[a-zA-Zа-яА-ЯіІїЇєЄґҐ\'\s\-]+$/u", $lastName)) {
        echo "Помилка: Ім'я та прізвище повинні містити лише літери.";
    } 
    else {
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);

        echo "<h1>Привіт, $firstName $lastName!</h1>";
        echo "<p>Твої дані успішно оброблено.</p>";
    }
} else {
    echo "Помилка: Дані не були надіслані через форму.";
}
?>