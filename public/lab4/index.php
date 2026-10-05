<?php
require_once 'StaticCache.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №4: Робота з кешем</title>
    <link rel="stylesheet" href="client-cache-css.php">
</head>
<body>

    <h1>Лабораторна робота №4: Робота з кешем в Web на PHP</h1>

    <div class="card">
        <h2>1. Клієнтське кешування (HTTP Headers)</h2>
        <p>1. <b>CSS-файл</b> підключено через <code>&lt;link rel="stylesheet" href="client-cache-css.php"&gt;</code> (заголовки <code>max-age=86400</code>).</p>
        <p>2. <b>JSON API:</b> <button onclick="fetchJson()">Зробити Fetch-запит</button></p>
        <div id="json-result"></div>
    </div>

    <div class="card">
        <h2>2. Серверне кешування (Статична властивість класу)</h2>
        <?php
        $start1 = microtime(true);$res1 = UserRepository::getUser(1);
        $time1 = round((microtime(true) -$start1) * 1000, 2);

        $start2 = microtime(true);$res2 = UserRepository::getUser(1); 
        $time2 = round((microtime(true) -$start2) * 1000, 2);
        ?>
        <p><b>Перший виклик:</b> <?= $res1['source'] ?> — Час: <?= $time1 ?> мс</p>
        <p><b>Другий виклик (того ж ID):</b> <?= $res2['source'] ?> — Час: <?= $time2 ?> мс</p>
    </div>

    <div class="card">
        <h2>3. Серверне кешування через PHP-сесію</h2>
        <button onclick="fetchSessionCache()">Запросити дані з сесії</button>
        <div id="session-result" style="margin-top: 10px;"></div>
    </div>

    <div class="card">
        <h2>4. Серверне кешування у файл (HTML-звіт 1000 рядків)</h2>
        <button onclick="loadReport()">Завантажити / Оновити звіт</button>
        <div id="report-time" style="margin-top: 10px; font-weight: bold;"></div>
        <div id="report-container" style="max-height: 300px; overflow-y: auto; margin-top: 10px;"></div>
    </div>

    <script>
        function fetchJson() {
            fetch('client-cache-json.php')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('json-result').innerHTML = 
                        `<pre>${JSON.stringify(data, null, 2)}</pre>`;
                });
        }

        function fetchSessionCache() {
            const start = performance.now();
            fetch('session-cache.php')
                .then(res => res.json())
                .then(data => {
                    const duration = Math.round(performance.now() - start);
                    document.getElementById('session-result').innerHTML = 
                        `Час запиту: <b>${duration} мс</b><br>Джерело: <b>${data.source}</b><br>Дані: ${JSON.stringify(data.data)}`;
                });
        }

        function loadReport() {
            const start = performance.now();
            fetch('generate-report.php')
                .then(res => res.text())
                .then(html => {
                    const duration = Math.round(performance.now() - start);
                    document.getElementById('report-time').innerText = `Час завантаження звіту: ${duration} мс`;
                    document.getElementById('report-container').innerHTML = html;
                });
        }
    </script>
</body>
</html>