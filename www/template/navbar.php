<nav class="navbar navbar-expand-md mb-3 bg-warning-subtle rounded">
  <div class="container-fluid">
    <button class="navbar-toggler me-auto border-0 px-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Apri navigazione">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if (!isUserLoggedIn()): ?>
      <a class="btn btn-outline-dark d-md-none" href="login.php">Accedi</a>
    <?php else: ?>
      <a class="icon-link link-dark fs-2 mx-1 d-md-none" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
      </a>
    <?php endif; ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-md-0 gap-md-3">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">I nostri Pet</a>
        </li>
        <?php if (!isLoggedUserAdmin()): ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Prenota sessione</a>
          </li>
        <?php endif; ?>
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
      <a class="icon-link link-dark fs-2 mx-3 d-none d-md-flex" href="#" aria-label="Profilo">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
      </a>
      <a class="btn btn-outline-dark d-none d-md-flex" href="logout.php">Logout</a>
    <?php endif; ?>
  </div>
</nav>

