<?php
$data = [
    "status" => "success",
    "message" => "Це дані клієнтського кешу",
    "version" => "1.0.0"
];

$json = json_encode($data, JSON_UNESCAPED_UNICODE);
$etag = md5($json); 

header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: public, max-age=3600"); 
header("ETag: \"$etag\"");

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) === "\"$etag\"") {
    header("HTTP/1.1 304 Not Modified");
    exit;
}

echo $json;