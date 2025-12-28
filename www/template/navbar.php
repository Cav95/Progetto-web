<?php

if (isset($_POST["logChange"])) {
    if (isUserLoggedIn()) {
      session_unset();
    }
    header("Location: login.php");
    exit;
}

$templateParams["navbtn"] = isUserLoggedIn() ? "Logout" : "Accedi";

?>

<nav class="navbar navbar-expand-md mb-3 bg-warning-subtle rounded">
  <div class="container-fluid">
    <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Apri navigazione">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pet</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Prenotazioni
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Nuova prenotazione</a></li>
            <!-- <li><a class="dropdown-item" href="#">Cancella prenotazione</a></li> -->
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Vedi prenotazioni</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="#" method="POST">
        <button class="btn btn-outline-dark" type="submit" name="logChange"><?php echo $templateParams["navbtn"]; ?></button>
      </form>
    </div>
  </div>
</nav>

