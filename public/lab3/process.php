<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileUpload'])) {
    
    $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
    $fileName = basename($_FILES['fileUpload']['name']);
    $fileSize = $_FILES['fileUpload']['size'];
    $fileType = $_FILES['fileUpload']['type'];

    if (is_uploaded_file($fileTmpPath)) {
        
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $maxSize = 2 * 1024 * 1024; 

        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Помилка: Дозволено завантажувати лише файли png, jpg або jpeg. <a href='index.html'>Повернутися</a>");
        }

        if ($fileSize > $maxSize) {
            die("Помилка: Розмір файлу перевищує 2 МБ. <a href='index.html'>Повернутися</a>");
        }

        $destination = $uploadDir . $fileName;
        
        if (file_exists($destination)) {
            echo "<p style='color: orange;'>Файл з іменем <b>$fileName</b> вже існує. Додаємо унікальний суфікс.</p>";
            $filenameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
            $newFileName = $filenameWithoutExt . '_' . time() . '.' . $fileExtension;
            $destination = $uploadDir . $newFileName;
            $fileName = $newFileName; 
        }

        if (move_uploaded_file($fileTmpPath, $destination)) {
            echo "<h3 style='color: green;'>Файл успішно завантажено!</h3>";
            echo "<ul>";
            echo "<li><b>Ім'я файлу:</b> " . htmlspecialchars($fileName) . "</li>";
            echo "<li><b>Тип файлу:</b> " . htmlspecialchars($fileType) . "</li>";
            echo "<li><b>Розмір файлу:</b> " . round($fileSize / 1024, 2) . " КБ</li>";
            echo "</ul>";
            echo "<p><a href='" . htmlspecialchars($destination) . "' download>📥 Завантажити файл назад</a></p>";
            echo "<br><a href='index.html'>Повернутися на головну</a>";
            
        } else {
            echo "Помилка збереження файлу на сервері.";
        }
    } else {
        echo "Помилка: файл не був успішно завантажений або атака через завантаження.";
    }
} else {
    echo "Некоректний запит.";
}
?>