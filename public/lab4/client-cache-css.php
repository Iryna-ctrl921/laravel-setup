<?php
$seconds = 86400; 

header("Content-Type: text/css; charset=UTF-8");
header("Cache-Control: public, max-age=" . $seconds);
header("Expires: " . gmdate('D, d M Y H:i:s', time() + $seconds) . ' GMT');

?>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
    margin: 20px;
}
.card {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
button {
    padding: 8px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #007bff;
    color: white;
}