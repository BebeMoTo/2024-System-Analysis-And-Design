<?php
require_once "config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $medAmount = htmlspecialchars($_POST["medAmount"]);
    $medDescription = htmlspecialchars($_POST["medDescription"]);

    //image handler
    if ($_FILES['image']['error'] === 4) {
        echo ("<script>alert(File does not exist!)</script>");
        exit();
    } else {
        $fileName = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $tmpName = $_FILES['image']['tmp_name'];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        //MAKEEEEEEEEEEEEEEEEE OUTPUUUUUUUUUUT HEEEEEEEEEEEEEERE
        if (!in_array($imageExtension, $validImageExtension)) {
            header("Location: ../adminPage.php?submitError");
        } else if ($filesize > 10000000) {
            header("Location: ../adminPage.php?errorLargeFile");
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            $addressForDb = "images/medPics/" . $newImageName;
            move_uploaded_file($tmpName, '../images/medPics/' . $newImageName);
        }
    }

    //value handler
    if (empty($name) || empty($medAmount) || empty($medDescription)) {
        exit();
        header("Location: ../adminPage.php?submitError");
    }

    //saving to database
    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO meds (medName, medDescription, medImage, medAmount) VALUES (:medName, :medDescription, :medImage, :medAmount);";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":medName", $name);
        $stmt->bindParam(":medDescription", $medDescription);
        $stmt->bindParam(":medImage", $addressForDb);
        $stmt->bindParam(":medAmount", $medAmount);

        $stmt->execute();

        header("Location: ../adminPage.php?addMedSuccess");
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }
} else {
    header("Location: ../adminPage.php?submitError");
}
