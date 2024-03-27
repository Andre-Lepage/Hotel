<?php

$dsn = "mysql:host=sql300.infinityfree.com;dbname=if0_36246649_hotel_management";
$dbusername = "if0_36246649";
$dbpassword = "Csigroupe341";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//test change