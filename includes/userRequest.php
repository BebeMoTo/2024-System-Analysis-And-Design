<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $medSelect = htmlspecialchars($_POST["medSelect"]);
    $medAmount = htmlspecialchars($_POST["medAmount"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $idNum = htmlspecialchars($_POST["idNum"]);

    //value handler
    if (empty($medSelect) || empty($medAmount) || empty($firstName) || empty($lastName) || empty($idNum)) {
        exit();
        header("Location: ../adminPage.php?submitError");
    }

    //saving to database
    try {
        require_once "dbh.inc.php";
        $query1 = "SELECT * FROM meds WHERE medID = $medSelect;";

        $stmt1 = $pdo->prepare($query1);

        $stmt1->execute();

        $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $origMedName = '';
        foreach ($results1 as $row) {
            $origMedName = htmlspecialchars($row["medName"]);
            $medStored = htmlspecialchars($row["medAmount"]);
            if ($medAmount > $medStored) {
                header("Location: ../adminPage.php?tooMuchRequest");
            } else {
                $newAmount = $medStored - $medAmount;
                $query2 = "UPDATE meds SET medAmount = $newAmount WHERE medID = $medSelect;";

                $stmt2 = $pdo->prepare($query2);
                $stmt2->execute();
            }
        }
        $query3 = "INSERT INTO history (firstName, lastName, idNum, medID, amount, medName) VALUES (:firstName, :lastName, :idNum, :medID, :amount, :medName);";
        echo ("TITo");
        $stmt3 = $pdo->prepare($query3);
        $stmt3->bindParam(":firstName", $firstName);
        $stmt3->bindParam(":lastName", $lastName);
        $stmt3->bindParam(":idNum", $idNum);
        $stmt3->bindParam(":medID", $medSelect);
        $stmt3->bindParam(":amount", $medAmount);
        $stmt3->bindParam(":medName", $origMedName);

        $stmt3->execute();


        header("Location: ../adminPage.php?addMedSuccess");
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }
} else {
    header("Location: ../adminPage.php?submitError");
}
