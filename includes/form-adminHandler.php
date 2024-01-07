<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminUsername = htmlspecialchars($_POST["adminUsername"]);
    $adminPassword = htmlspecialchars($_POST["adminPassword"]);


    if (empty($adminUsername) || empty($adminPassword)) {
        exit();
        header("Location: ../index.php?loginError");
    }

    //connecting to database
    try {
        require_once "dbh.inc.php";

        $query = "SELECT * FROM admin WHERE username = :adminUsername AND password = :adminPassword;";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":adminUsername", $adminUsername);
        $stmt->bindParam(":adminPassword", $adminPassword);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
            header("Location: ../index.php?loginError");
        } else {
            require_once 'config.php';
            $_SESSION['username'] = $adminUsername;
            header("Location: ../adminPage.php");
        }
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }

    //going to admin page
    //header("Location: ../adminPage.php");
} else {
    header("Location: ../index.php?loginError");
}
