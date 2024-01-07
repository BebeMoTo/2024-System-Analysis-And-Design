<?php

$dsn = "mysql:host=localhost;dbname=automated_healthcare_system";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {

    //try this withoud opening xampp
    echo "Connection failed: " > $e->getMessage();
}