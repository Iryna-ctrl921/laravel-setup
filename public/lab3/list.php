<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список файлів</title>
</head>
<body>
    <h2>Завантажені файли у папці 'uploads':</h2>
    <ul>
        <?php
        $uploadDir = 'uploads/';

        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            $hasFiles = false;

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $hasFiles = true;
                    $filePath = $uploadDir . $file;
                    
                    echo "<li>";
                    echo htmlspecialchars($file) . " ";
                    echo "<a href='" . htmlspecialchars($filePath) . "' download>[Завантажити]</a>";
                    echo "</li>";
                }
            }

            if (!$hasFiles) {
                echo "<li>Папка порожня. Жоден файл ще не завантажено.</li>";
            }
        } else {
            echo "<li>Директорія uploads не знайдена. Спочатку завантажте файл.</li>";
        }
        ?>
    </ul>
    
    <br>
    <a href="index.html">Повернутися на головну</a>
</body>
</html>