<?php

$dsn = "mysql:host=sql205.infinityfree.com;dbname=if0_36143582_groupe34";
$dbusername = "if0_36143582";
$dbpassword ="groupe34csi";

try{
    $pdo = new PDO($dsn, $dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}