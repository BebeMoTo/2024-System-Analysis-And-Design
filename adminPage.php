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

    .card img {
      height: 300px;
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

    .me-auto {
      color: white;
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
            <a class="nav-link" aria-current="page" href="includes/logout.php">Log-Out</a>
            <a class="nav-link active historyBtn">History</a>
            <a class="nav-link medicinesBtn">Medicines</a>
            <a class="nav-link usersBtn">Users</a>
            <a class="nav-link requestBtn">Requests</a>
          </ul>
        </div>
      </div>
    </nav>

    <div class="titlebox">
      <h2 class="adminTitle" style="display: inline-block;">History</h2>
      <button style="margin-right: 20px; z-index: 3;" type="button" class="btn btn-light hidden addMedBtn">Add Medicine</button>
    </div>
    <!--SSHEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEESH-->
    <section class="history section">
      <?php
      //for HISTORY
      try {


        $query = "SELECT * FROM history ORDER BY createdAt DESC;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          echo ('
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
              <strong class="me-auto">Warning!!!</strong>
              <small>Shooot!</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              It seems like there is nothing in database.
            </div>
          </div>
        </div>
          ');
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


        $query = "SELECT * FROM meds ORDER BY medName;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          echo ('
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
              <strong class="me-auto">Warning!!!</strong>
              <small>Shooot!</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              It seems like there is nothing in database.
            </div>
          </div>
        </div>
          ');
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

              <form method="GET" action="includes/medUpdate.php" class="addMedForm' . $medID . '">
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
      <?php
      //for USERS
      try {

        $query = "SELECT * FROM userinfo ORDER BY lastName;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          echo ('
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
              <strong class="me-auto">Warning!!!</strong>
              <small>Shooot!</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              It seems like there is nothing in database.
            </div>
          </div>
        </div>
          ');
        } else {
          foreach ($results as $row) {
            $userName = htmlspecialchars($row["lastName"]) . ', ' . htmlspecialchars($row["firstName"]);
            $lastName = htmlspecialchars($row["lastName"]);
            $firstName = htmlspecialchars($row["firstName"]);
            $id = htmlspecialchars($row["idNum"]);
            $userAge = htmlspecialchars($row["age"]);
            $userSex = htmlspecialchars($row["sex"]);
            $userAddress = htmlspecialchars($row["address"]);
            $userEmergency = htmlspecialchars($row["emergency"]);
            $userDiagnosis = htmlspecialchars($row["diagnosis"]);

            echo ('
            <div class="card" style="width: 90%;">
            <div class="card-body">
              <h5 class="card-title">' . $userName . '</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Age: ' . $userAge . ' / Gender: ' . $userSex . '</h6>
              <p class="card-text">Address: ' . $userAddress . '<br>Medical Condition/s: ' . $userDiagnosis . '<br>Emergency: ' . $userEmergency . '</p>
              <button class="btn btn-primary requestMedButton" onclick="openRequestModal(`' . $firstName . '`,`' . $lastName . '`, ' . $id . ')">Request</button>
              
              <a href="ID/ID_TEMPLATE.php?id=' . $id . '" class="btn btn-primary">ID</a>

              <a href="includes/userDelete.php?id=' . $id . '" class="btn btn-danger">Delete</a>
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
    <section class="requests section hidden">
      <?php
      //for REQUESTS
      try {
        $query = "SELECT * FROM requests ORDER BY createdAt DESC;";

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results)) {
          echo ('
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
              <strong class="me-auto">Warning!!!</strong>
              <small>Shooot!</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              It seems like there is nothing in database.
            </div>
          </div>
        </div>
          ');
        } else {
          foreach ($results as $row) {
            $reqUserID = htmlspecialchars($row["userID"]);
            $reqMedID = htmlspecialchars($row["medID"]);
            $reqMedAmount = htmlspecialchars($row["medAmount"]);
            $reqDate = htmlspecialchars($row["createdAt"]);
            $requestID = htmlspecialchars($row["requestID"]);

            $query2 = "SELECT * FROM userinfo WHERE idNum = $reqUserID;";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute();
            $results2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results2 as $row) {
              $reqFirstName = htmlspecialchars($row["firstName"]);
              $reqLastName = htmlspecialchars($row["lastName"]);
              $reqUsername = htmlspecialchars($row["lastName"]) . ', ' . htmlspecialchars($row["firstName"]);
            }

            $query3 = "SELECT * FROM meds WHERE medID = $reqMedID;";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute();
            $results3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results3 as $row) {
              $reqMedName = htmlspecialchars($row["medName"]);
              $reqMedDescription = htmlspecialchars($row["medDescription"]);
            }

            echo ('
                <div class="card" style="border-radius: 0;">
                <div class="card-header">
                  Date Requested: ' . $reqDate . '
                </div>
                <div class="card-body bg-dark">
                  <h5 class="card-title" style="color: white;">' . $reqUsername . '</h5>
                  <p class="card-text" style="color: white;">Requested Medicine: ' . $reqMedName . '<br>Requested Amount: x' . $reqMedAmount . '</p>
                  <a href="includes/requestsGrant.php?historyID=' . $requestID . '" class="btn btn-primary">Grant</a>
                  <a href="includes/requestDelete.php?historyID=' . $requestID . '" class="btn btn-danger">Delete</a>
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
    <section class="admins section hidden">

    </section>
    <div class="darken hidden" style="z-index: 2; position:fixed; top:0; left:0;"></div>
    <!--NEEEEEEEEEEEEEEEW MEEEEEEEEEEEEEEEEEED-->
    <div class="register-form hidden newMedForm">
      <form class="form" action="includes/medNewHandler.php" method="POST" enctype="multipart/form-data">
        <p class="title">Add Medicine</p>
        <div class="flex">
          <label>
            <input required="" placeholder="" type="text" class="input" name="name">
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
          <input required="" placeholder="" type="file" class="input" name="image" accept="image/*">
        </label>
        <button class="submit">SUBMIT</button>
      </form>
    </div>
    <!--REEEEEEEEEEEEEEQQQQQQQQUUUUUUUUEEEEEEEEESSSSSSSSTTTTTTTTTTTTTT-->
    <?php
    //for USERS REQUEST
    try {

      $query = "SELECT * FROM meds ORDER BY medName;";

      $stmt = $pdo->prepare($query);

      $stmt->execute();

      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($results)) {
        echo ('
              <div class="toast-container position-fixed bottom-0 end-0 p-3">
              <div id="liveToast3" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger">
                  <strong class="me-auto">Warning!!!</strong>
                  <small style="color: white;">Shooot!</small>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-dark" style="color:white">
                  Please add a medicine first.
                </div>
              </div>
            </div>

            <script>
              const toastTriggerRequest = document.querySelectorAll(".requestMedButton");
              const toastLiveExample3 = document.getElementById("liveToast3");
              toastTriggerRequest.forEach(toast => {
                  if (toast) {
                      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample3)
                      toast.addEventListener("click", () => {
                        toastBootstrap.show()
                      })
                    }
              })
            </script>
            ');
      } else {
        echo ('
                  <div class="register-form hidden requestMed" style="position: fixed; top: 50%; left: 50%; translate: -50% -50%;">
                  <form class="form" action="includes/userRequest.php" method="POST" autocomplete="off">
                    <p class="title">Medicine Request</p>
                    <div class="flex">
                      <label>
                        <select class="form-select" name="medSelect" aria-label="Default select example">
                  ');
        foreach ($results as $row) {
          $medName = htmlspecialchars($row["medName"]);
          $medID = htmlspecialchars($row["medID"]);

          echo ('
                      <option value="' . $medID . '">' . $medName . '</option>
                        ');
        }
        echo ('
        </select>
        </label>
    
    
        <label>
          <input required="" placeholder="" type="number" class="input" name="medAmount">
          <span>Madicine Amount</span>
        </label>
        </div>
        <input hidden type="text" name="firstName" class="firstName">
        <input hidden type="text" name="lastName" class="lastName">
        <input hidden type="num" name="idNum" class="idNum">
    
        <button class="submit">Submit</button>
        <p class="btn btn-danger closeMedRequest">Close</p>
        </form>
        </div>

        <script>
        const closeMedRequest = document.querySelector(".closeMedRequest");
        closeMedRequest.addEventListener("click", function() {
            const requestMed= document.querySelector(".requestMed");
            requestMed.classList.add("hidden");
            darken.classList.add("hidden");
        })
        function openRequestModal(fName, lName, id) {
            const requestMed= document.querySelector(".requestMed");
            const firstName= document.querySelector(".firstName");
            const lastName= document.querySelector(".lastName");
            const idNum= document.querySelector(".idNum");
        
            darken.classList.remove("hidden");
            requestMed.classList.remove("hidden");
            firstName.value = `${fName}`;
            lastName.value = `${lName}`;
            idNum.value = `${id}`;
        }
        
        </script>
        ');
      }
    } catch (PDOException $e) {
      die("Query Failed: " > $e->getMessage());
    }
    ?>


  </header>
  <div class="myToasterDeleteSuccess hidden">
    <small>DELETED SUCCESSFULLY!!!</small>
  </div>
  <div class="myToasterAddedSuccess hidden">
    <small>ADDED SUCCESSFULLY!!!</small>
  </div>
  <div class="myToasterAddedSuccesss hidden">
    <small>CHANGED SUCCESSFULLY!!!</small>
  </div>
  <div class="myToasterTooLarge hidden">
    <small>MEDICINE NOT ENOUGH!!!</small>
  </div>




  <script>
    if (window.location.href.includes("deleteSuccess")) {
      const myToasterDeleteSuccess = document.querySelector('.myToasterDeleteSuccess');
      myToasterDeleteSuccess.classList.remove("hidden");
      setTimeout(() => {
        myToasterDeleteSuccess.classList.add("hidden");
      }, 3000);
    };
    if (window.location.href.includes("addMedSuccess")) {
      const myToasterAddedSuccess = document.querySelector('.myToasterAddedSuccess');
      myToasterAddedSuccess.classList.remove("hidden");
      setTimeout(() => {
        myToasterAddedSuccess.classList.add("hidden");
      }, 3000);
    };
    if (window.location.href.includes("updateSuccess")) {
      const myToasterAddedSuccesss = document.querySelector('.myToasterAddedSuccesss');
      myToasterAddedSuccesss.classList.remove("hidden");
      setTimeout(() => {
        myToasterAddedSuccesss.classList.add("hidden");
      }, 3000);
    };
    if (window.location.href.includes("tooMuchRequest")) {
      const myToasterTooLarge = document.querySelector('.myToasterTooLarge');
      myToasterTooLarge.classList.remove("hidden");
      setTimeout(() => {
        myToasterTooLarge.classList.add("hidden");
      }, 3000);
    };
  </script>


  <script src="bootstrap.js"></script>
  <script src="indexAdmin.js"></script>
</body>

</html>