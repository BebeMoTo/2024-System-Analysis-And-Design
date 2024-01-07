<?php
require_once "includes/dbh.inc.php";
require_once "includes/config.php";
if (!isset($_SESSION['username'])) {
  session_unset();
  session_destroy();
  header("Location: index.php?loginError");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN || Automated Healthcare System</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="index.css">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <style>
    .card {
      max-width: 90%;
      margin: auto;
      margin-bottom: 20px;
    }

    .medCard {
      flex-basis: 30%;
      flex-shrink: 1;
      min-width: 300px;
    }

    .medicines {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .hidden {
      display: none;
    }

    .titlebox {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <header class="header-main" style="position: relative;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark" style="z-index: 3;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">ADMIN PAGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
            <a class="nav-link active historyBtn">History</a>
            <a class="nav-link medicinesBtn">Medicines</a>
            <a class="nav-link usersBtn">Users</a>
            <a class="nav-link adminsBtn">Admins</a>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search User" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="titlebox">
      <h2 class="adminTitle" style="display: inline-block;">History</h2> <button style="margin-right: 20px; z-index: 3;" type="button" class="btn btn-light hidden addMedBtn">Add Medicine</button>
    </div>
    <!--SSHEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEESH-->
    <section class="history section">
      <?php
      //for HISTORY
      try {


        $query = "SELECT * FROM history LEFT JOIN meds ON history.medID = meds.medID;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          header("Location: ../adminPage.php?noHistory");
        } else {
          foreach ($results as $row) {
            $historyID = htmlspecialchars($row["historyID"]);
            $historyDate = htmlspecialchars($row["createdAt"]);
            $historyUsername = htmlspecialchars($row["firstName"]) . ' ' . htmlspecialchars($row["lastName"]);
            $medName = htmlspecialchars($row["medName"]);
            $amount = htmlspecialchars($row["amount"]);

            echo ('
                <div class="card">
                <div class="card-header">
                  Date: ' . $historyDate . '
                </div>
                <div class="card-body">
                  <h5 class="card-title">' . $historyUsername . '</h5>
                  <p class="card-text">' . $medName . ' x' . $amount . '</p>
                  <a href="includes/historyDelete.php?historyID=' . $historyID . '" class="btn btn-danger">Delete</a>
                </div>
              </div>
                ');
          }
        }
      } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
      }
      ?>
    </section>
    <!--SSHEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEESH-->
    <section class="medicines section hidden">
      <?php
      //for MEDICINES
      try {


        $query = "SELECT * FROM meds;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          header("Location: ../adminPage.php?noMedicine");
        } else {
          foreach ($results as $row) {
            $medID = htmlspecialchars($row["medID"]);
            $medName = htmlspecialchars($row["medName"]);
            $medDescription = htmlspecialchars($row["medDescription"]);
            $medImage = htmlspecialchars($row["medImage"]);
            $medAmount = htmlspecialchars($row["medAmount"]);

            echo ('
            <div class="card medCard" data-bs-theme="dark" style="width: 18rem;">
            <img src="' . $medImage . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . $medName . '</h5>
              <p class="card-text">' . $medDescription . '</p>

              <form method="GET" action="includes/medUpdate.php" class="addMedForm">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Amount</span>
                <input name="newAmount" type="number" value="' . $medAmount . '" class="form-control" placeholder="000" aria-label="Username" aria-describedby="basic-addon1">
                <input type="number" name="medID" value="' . $medID  . '" hidden>
              </div>

              <input class="btn btn-primary" type="submit" value="Update">
              <input class="btn btn-danger" type="button" value="Delete" onclick="deleteMedicine(' . $medID . ')">
              </form>
            </div>
          </div>
                ');
          }
        }
      } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
      }
      ?>
    </section>
    <!--SSHEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEESH-->
    <section class="users section hidden">

    </section>
    <!--SSHEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEESH-->
    <section class="admins section hidden">

    </section>
    <div class="darken hidden" style="z-index: 2; position:fixed; top:0; left:0;"></div>
    <!--NEEEEEEEEEEEEEEEW MEEEEEEEEEEEEEEEEEED-->
    <div class="register-form hidden newMedForm">
      <form class="form" action="includes/medNewHandler.php" method="POST">
        <p class="title">Add Medicine</p>
        <div class="flex">
          <label>
            <input required="" placeholder="" type="text" class="input" name="medName">
            <span>Medicine Name</span>
          </label>

          <label>
            <input required="" placeholder="" type="number" class="input" name="medAmount">
            <span>Madicine Amount</span>
          </label>
        </div>

        <label>
          <input required="" placeholder="" type="text" class="input" name="medDescription">
          <span>Description</span>
        </label>

        <label>
          <input required="" placeholder="" type="file" class="input" name="medImage" accept="image/*">
        </label>
        <button class="submit">Submit</button>
      </form>
    </div>
  </header>

  <script src="bootstrap.js"></script>
  <script src="indexAdmin.js"></script>
</body>

</html>