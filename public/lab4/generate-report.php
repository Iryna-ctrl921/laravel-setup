<?php
$cacheDir = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/report.html';
$cacheTtl = 600; 

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTtl)) {
    $age = time() - filemtime($cacheFile);
    echo "<p style='color: green;'><b>Джерело: ФАЙЛОВИЙ КЕШ (вік кешу: {$age} сек.)</b></p>";
    readfile($cacheFile);
    exit;
}

sleep(3); 

ob_start(); 
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Ім'я користувача</th>
            <th>Сума ($)</th>
            <th>Дата транзакції</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $names = ['Олександр', 'Марія', 'Ірина', 'Дмитро', 'Анна', 'Максим', 'Олена'];
        for ($i = 1; $i <= 1000; $i++):
            $name = $names[array_rand($names)];
            $amount = rand(100, 5000);
            $date = date('Y-m-d', strtotime('-' . rand(0, 30) . ' days'));
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $name ?></td>
                <td><?= $amount ?></td>
                <td><?= $date ?></td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
<?php
$htmlContent = ob_get_clean(); 

file_put_contents($cacheFile, $htmlContent);

echo "<p style='color: red;'><b>Джерело: НОВА ГЕНЕРАЦІЯ (згенеровано за 3 секунди та збережено у файл)</b></p>";
echo $htmlContent;