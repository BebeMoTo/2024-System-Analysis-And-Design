<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

$requestID = $_GET['requestID'];

//connecting to database
try {
    require_once "dbh.inc.php";

    $query4 = "DELETE FROM requests WHERE requestID = :requestID;";
    $stmt4 = $pdo->prepare($query4);
    $stmt4->bindParam(":requestID", $requestID);
    $stmt4->execute();

    header("Location: ../adminPage.php?deleteSuccess");
    die();
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
