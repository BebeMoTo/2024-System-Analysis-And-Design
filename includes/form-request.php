<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userID = htmlspecialchars($_POST["userID"]);
    $userMedSelect = htmlspecialchars($_POST["userMedSelect"]);
    $userRequestAmount = htmlspecialchars($_POST["userRequestAmount"]);

    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM meds WHERE medID = :medID";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":medID", $userMedSelect);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            header("Location: ../index.php?requestError");
        } else {
            $medStored = null;
            foreach ($results as $row) {
                $medStored = htmlspecialchars($row["medAmount"]);
                $medName = htmlspecialchars($row["medName"]);
            }
            if ($userRequestAmount > $medStored) {
                header('Location: ../index.php?requestError=1&medAmount=' . $medStored . '&medName=' . $medName);
            } else {
                $query1 = "SELECT * FROM userinfo WHERE idNum = :idNum;";

                $stmt1 = $pdo->prepare($query1);
                $stmt1->bindParam(":idNum", $userID);

                $stmt1->execute();

                $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                if (empty($results1)) {
                    header("Location: ../index.php?noUserFound");
                } else {
                    $query2 = "INSERT INTO requests (userID, medID, medAmount) VALUES (:userID, :medID, :medAmount);";

                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->bindParam(":userID", $userID);
                    $stmt2->bindParam(":medID", $userMedSelect);
                    $stmt2->bindParam(":medAmount", $userRequestAmount);

                    $stmt2->execute();

                    header("Location: ../index.php?requestAdded");
                }
            }
        }
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }
} else {
    header("Location: ../index.php?loginError");
}
