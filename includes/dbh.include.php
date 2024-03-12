<?php

$dsn = "mysql:host=sql203.infinityfree.com;if0_36149169_hotel_management";
$dbusername = "if0_36149169";
$dbpassword ="Csigroupe34";

try{
    $pdo = new PDO($dsn, $dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//test change