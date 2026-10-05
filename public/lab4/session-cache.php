<?php
session_start();

function generateData() {
    sleep(2); 
    return [
        'USD' => rand(4100, 4200) / 100,
        'EUR' => rand(4400, 4500) / 100,
        'BTC' => rand(60000, 70000)
    ];
}

$cacheTtl = 600; 

if (isset($_SESSION['cached_data']) && isset($_SESSION['cached_time'])) {
    $age = time() - $_SESSION['cached_time'];
    if ($age < $cacheTtl) {
        $data = $_SESSION['cached_data'];
        $source = "з кешу сесії (вік: {$age} сек.)";
    } else {
        $data = generateData();
        $_SESSION['cached_data'] = $data;
        $_SESSION['cached_time'] = time();
        $source = "оновлено новий кеш сесії";
    }
} else {
    $data = generateData();
    $_SESSION['cached_data'] = $data;
    $_SESSION['cached_time'] = time();
    $source = "створено новий кеш сесії";
}

header("Content-Type: application/json; charset=UTF-8");
echo json_encode([
    'data' => $data,
    'source' => $source,
    'time' => date('H:i:s')
], JSON_UNESCAPED_UNICODE);