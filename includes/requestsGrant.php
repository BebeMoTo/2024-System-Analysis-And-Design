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

    $query = "SELECT * FROM requests WHERE requestID = :requestID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":requestID", $requestID);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        $userID = htmlspecialchars($row["userID"]);
        $medID = htmlspecialchars($row["medID"]);
        $medAmount = htmlspecialchars($row["medAmount"]);
    }

    $query1 = "SELECT * FROM userinfo WHERE idNum = :idNum;";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->bindParam(":idNum", $userID);
    $stmt1->execute();
    $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results1 as $row) {
        $firstName = htmlspecialchars($row["firstName"]);
        $lastName = htmlspecialchars($row["lastName"]);
    }

    $query2 = "SELECT * FROM meds WHERE medID = :medID;";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam(":medID", $medID);
    $stmt2->execute();
    $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results2 as $row) {
        $medName = htmlspecialchars($row["medName"]);
    }

    $query3 = "INSERT INTO history (firstName, lastName, idNum, medID, amount, medName) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt3 = $pdo->prepare($query3);
    $stmt3->execute([$firstName, $lastName, $userID, $medID, $medAmount, $medName]);

    $query4 = "DELETE FROM requests WHERE requestID = :requestID;";
    $stmt4 = $pdo->prepare($query4);
    $stmt4->bindParam(":requestID", $requestID);
    $stmt4->execute();

    header("Location: ../adminPage.php?addMedSuccess");
    die();
} catch (PDOException $e) {
    die("Query Failed: " > $e->getMessage());
}
