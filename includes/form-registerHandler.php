<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $regFirstName = htmlspecialchars($_POST["regFirstName"]);
    $regLastName = htmlspecialchars($_POST["regLastName"]);
    $regAge = htmlspecialchars($_POST["regAge"]);
    $regSex = htmlspecialchars($_POST["regSex"]);
    $regAddress = htmlspecialchars($_POST["regAddress"]);
    $regEmergency = htmlspecialchars($_POST["regEmergency"]);
    $regDiagnosis = htmlspecialchars($_POST["regDiagnosis"]);

    if (empty($regFirstName) || empty($regLastName) || empty($regAge) || empty($regSex) || empty($regAddress) || empty($regEmergency) || empty($regDiagnosis)) {
        exit();
        header("Location: ../index.php?submitError");
    }

    //connecting to database
    try {
        require_once "dbh.inc.php";
        $query = "INSERT INTO userinfo (firstName, lastName, age, sex, address, emergency, diagnosis) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$regFirstName, $regLastName, $regAge, $regSex, $regAddress, $regEmergency, $regDiagnosis]);

        //closing connection to db
        $pdo = null;
        $stmt = null;
        header("Location: ../index.php?submitSuccessful");
        die();
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }
} else {
    header("Location: ../index.php?submitError");
}
