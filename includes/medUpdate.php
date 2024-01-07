<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

$medID = $_GET['medID'];
$newAmount = $_GET['newAmount'];

//connecting to database
try {
    require_once "dbh.inc.php";

    $query = "UPDATE meds SET medAmount = :medAmount WHERE medID = :medID;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":medAmount", $newAmount);
    $stmt->bindParam(":medID", $medID);

    $stmt->execute();

    header("Location: ../adminPage.php?updateSuccess");
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
