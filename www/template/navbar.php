<nav class="navbar navbar-expand-md mb-3 bg-warning-subtle rounded">
  <div class="container-fluid">
    <a class="navbar-brand d-none d-md-flex align-content-center" href="index.php">
      <img src="<?php echo DESIGN_IMG_DIR . "Zampa_P.png"; ?>" alt="Logo" class="img-fluid logo">
    </a>
    <button class="navbar-toggler me-auto border-0 px-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Apri navigazione">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if (!isUserLoggedIn()): ?>
      <a class="btn btn-outline-dark d-md-none" href="login.php">Accedi</a>
    <?php else: ?>
      <a class="icon-link link-dark fs-2 mx-1 d-md-none" href="utente.php">
        <svg class="icon" aria-label="Area utente"><use href="#icon-user-circle"></use></svg>
      </a>
    <?php endif; ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-md-0 gap-md-3">
        <li class="nav-item">
          <a class="nav-link" href="petpage.php">
            <?php echo isLoggedUserAdmin() ? "Gestisci Pet" : "I nostri Pet"; ?>
          </a>
        </li>
        <?php if (!isLoggedUserAdmin()): ?>
          <li class="nav-item">
            <a class="nav-link" href="nuova-prenotazione.php">Prenota sessione</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="prenotazioni.php">
            <?php echo isLoggedUserAdmin() ? "Gestisci prenotazioni" : "Le tue prenotazioni"; ?>
          </a>
        </li>
        <?php if (isUserLoggedIn()): ?>
          <li class="nav-item">
            <a class="btn btn-outline-dark d-md-none" href="logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <?php if (!isUserLoggedIn()): ?>
      <a class="btn btn-outline-dark d-none d-md-flex" href="login.php">Accedi</a>
    <?php else: ?>
      <a class="link-dark mx-3 d-none d-md-flex link-opacity-75-hover" href="utente.php" aria-label="Profilo">
          <?php echo $_SESSION["email"]; ?>
      </a>
      <a class="btn btn-outline-dark d-none d-md-flex" href="logout.php">Logout</a>
    <?php endif; ?>
  </div>
</nav>

