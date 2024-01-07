<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

$historyID = $_GET['historyID'];

//connecting to database
try {
    require_once "dbh.inc.php";

    $query = "DELETE FROM history WHERE historyID = :historyID;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":historyID", $historyID);

    $stmt->execute();

    header("Location: ../adminPage.php?deleteSuccess");
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
