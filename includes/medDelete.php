<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}
echo ("TITE");
$newAmmount = $_GET['newAmount'];
$medID = $_GET['medID'];

//connecting to database
try {
    require_once "dbh.inc.php";

    $query = "DELETE FROM meds WHERE medID = :medID;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":medID", $medID);

    $stmt->execute();

    header("Location: ../adminPage.php?deleteSuccess");
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
