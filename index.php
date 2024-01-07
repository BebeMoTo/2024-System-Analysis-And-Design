<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Automated Healthcare System</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="index.css">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>

<body>
  <header class="header-main">
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-underline fixed-top" data-bs-theme="dark" style="z-index: 5;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">HEALTHCARE SYSTEM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a onclick="" class="nav-link active" aria-current="page" href="#">Home</a>
            <a class="nav-link id">I.D.</a>
            <a class="nav-link admin">Admin</a>
            <a class="nav-link developer-button">Developers</a>
          </div>
        </div>
      </div>
    </nav>
    <h1 class="title-main">Automated Healthcare<br>System</h1>
    <div class="darken hidden"></div>

    <div class="developers hidden">
      <div class="accordion accordion-flush" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Arañez, Kevin
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <img src="images/background.jpg" alt="">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eum natus accusantium corporis atque, nam dolores aliquam esse vero quo iusto delectus minima consequuntur non quibusdam fugit alias id dolore.</p>
              <div class="socials">
                <span class="socEmail socCrumbs"><a href="">E-mail</a></span>
                <span class="socFacebook socCrumbs"><a href="">Facebook</a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Buitre, Jay-R
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <img src="images/background.jpg" alt="">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eum natus accusantium corporis atque, nam dolores aliquam esse vero quo iusto delectus minima consequuntur non quibusdam fugit alias id dolore.</p>
              <div class="socials">
                <span class="socEmail socCrumbs"><a href="mailto:jayrbuitre0226@gmail.com">E-mail</a></span>
                <span class="socFacebook socCrumbs"><a href="https://web.facebook.com/jayrculdora.buitre">Facebook</a></span>
                <span class="socInsta socCrumbs"><a href="https://www.instagram.com/bebeniyato/">Instagram</a></span>
                <span class="socGithub socCrumbs"><a href="https://github.com/BebeMoTo">Github</a></span>
                <span class="socLinked socCrumbs"><a href="https://www.linkedin.com/in/jay-r-buitre-671b17256/">LinkedIn</a></span>

              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Miana, David Jr.
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <img src="images/background.jpg" alt="">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eum natus accusantium corporis atque, nam dolores aliquam esse vero quo iusto delectus minima consequuntur non quibusdam fugit alias id dolore.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Lozada, John Roland
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <img src="images/background.jpg" alt="">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eum natus accusantium corporis atque, nam dolores aliquam esse vero quo iusto delectus minima consequuntur non quibusdam fugit alias id dolore.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Romero, Paul Patrick
            </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="register-form hidden">
    <form class="form" action="includes/form-registerHandler.php" method="POST">
      <p class="title">Register </p>
      <p class="message"></p>
      <div class="flex">
        <label>
          <input required="" placeholder="" type="text" class="input" name="regFirstName">
          <span>Firstname</span>
        </label>

        <label>
          <input required="" placeholder="" type="text" class="input" name="regLastName">
          <span>Lastname</span>
        </label>
      </div>

      <div class="flex">
        <label>
          <input required="" placeholder="" type="number" class="input" name="regAge">
          <span>Age</span>
        </label>

        <label>
          <input required="" placeholder="" type="text" class="input" name="regSex">
          <span>Sex</span>
        </label>
      </div>

      <label>
        <input required="" placeholder="" type="text" class="input" name="regAddress">
        <span>Address</span>
      </label>

      <label>
        <input required="" placeholder="" type="text" class="input" name="regEmergency">
        <span>Contact in Case of Emergency - Phone</span>
      </label>
      <label>
        <input required="" placeholder="" type="text" class="input" name="regDiagnosis">
        <span>Diagnosis</span>
      </label>
      <button class="submit">Submit</button>
    </form>
  </div>

  <div class="admin-form hidden">
    <form class="form1" action="includes/form-adminHandler.php" method="POST" autocomplete="off">
      <p class="title">Admin Log-In </p>
      <p class="message"></p>
      <label>
        <input required="" placeholder="" type="text" class="input" name="adminUsername">
        <span>Username</span>
      </label>
      <label>
        <input required="" placeholder="" type="password" class="input" name="adminPassword">
        <span>Password</span>
      </label>
      <button class="submit">Submit</button>
    </form>
  </div>


  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-primary">
        <strong class="me-auto" style="color: white;">Success!!!</strong>
        <small style="color: white;">Yayyy!!!</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Details Saved 😁😁😁
      </div>
    </div>
  </div>

  <script src="bootstrap.js"></script>
  <script src="index.js"></script>
  <script>
    if (window.location.href.includes("submitSuccessful")) {
      const toastLiveExample = document.getElementById('liveToast');
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
      toastBootstrap.show();
    }
  </script>
</body>

</html>