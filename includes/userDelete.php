<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

$idNum = $_GET['id'];

//connecting to database
try {
    require_once "dbh.inc.php";

    $query = "DELETE FROM userinfo WHERE idNum = :idNum;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":idNum", $idNum);

    $stmt->execute();

    header("Location: ../adminPage.php?deleteSuccess");
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
