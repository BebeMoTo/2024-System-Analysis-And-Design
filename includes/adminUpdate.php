<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

$newUsername = $_GET['newUsername'];
$newPassword = $_GET['newPassword'];
$adminID = $_GET['adminID'];

try {
    require_once "dbh.inc.php";

    $query = "UPDATE admin SET username = :newUsername, password = :newPassword WHERE adminID = :adminID;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":newUsername", $newUsername);
    $stmt->bindParam(":newPassword", $newPassword);
    $stmt->bindParam(":adminID", $adminID);

    $stmt->execute();

    header("Location: ../adminPage.php?updateSuccess");
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
