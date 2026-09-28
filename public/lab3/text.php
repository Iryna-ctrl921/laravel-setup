<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['textInput'])) {
    $text = trim($_POST['textInput']);
    
    if (!empty($text)) {
        $entry = "[" . date('Y-m-d H:i:s') . "] " . $text . PHP_EOL;

        file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);
        echo "<p style='color: green;'>Текст успішно збережено у файл!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Читання з файлу</title>
</head>
<body>
    <h2>Вміст файлу log.txt:</h2>
    
    <div style="background-color: #f4f4f4; padding: 15px; border: 1px solid #ddd;">
        <?php
        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            echo nl2br(htmlspecialchars($content));
        } else {
            echo "Файл log.txt ще не створено або він порожній.";
        }
        ?>
    </div>
    
    <br>
    <a href="index.html">Повернутися на головну</a>
</body>
</html>