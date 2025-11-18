<!DOCTYPE html>
<html lang="it" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title><?php echo $templateParams["title"]; ?></title>
</head>

<body class="container-fluid bg-body p-0 overflow-x-hidden">
  <header class="bg-warning p-4">
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
              <a class="nav-link" href="#">Animali</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Prenotazioni
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Nuova prenotazione</a></li>
                <li><a class="dropdown-item" href="#">Cancella prenotazione</a></li>
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

    <div class="row">
      <div class="col col-md-8">
        <h1 class="visually-hidden">Unibo Pet Therapy</h1>
        <a href="index.php"><img src="<?php echo DESIGN_IMG_DIR . "Titolo.png"; ?>" alt="Unibo Pet Therapy" class="img-fluid w-50"></a>
      </div>
      <div class="col-md-4">

      </div>
    </div>

  </header>
  <div class="row g-0 bg-body-tertiary">
    <div class="col-lg-9 col">
      <main>
        <?php include $templateParams["nome"]; ?>
      </main>
    </div>
    <div class="col-lg-3 border-start border-2 px-3 pb-3">
      <aside>
        <h3 class="text-center my-3 h4">Notizie</h3>
        <div class="row px-2 g-3">

          <div class="card col-12">
            <div class="card-body">
              <h5 class="card-title">Nuovi animali in arrivo!</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Data articolo: 16/11/2025</h6>
              <p class="card-text">Da venerdì arriveranno a farci compagnia anche i cani Pippo e Pluto!</p>
              <a href="#" class="card-link">Leggi tutto</a>
            </div>
          </div>
          <div class="card col-12">
            <div class="card-body">
              <h5 class="card-title">Nuovi animali in arrivo!</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Data articolo: 16/11/2025</h6>
              <p class="card-text">Da venerdì arriveranno a farci compagnia anche i cani Pippo e Pluto!</p>
              <a href="#" class="card-link">Leggi tutto</a>
            </div>
          </div>
          <div class="card col-12">
            <div class="card-body">
              <h5 class="card-title">Nuovi animali in arrivo!</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Data articolo: 16/11/2025</h6>
              <p class="card-text">Da venerdì arriveranno a farci compagnia anche i cani Pippo e Pluto!</p>
              <a href="#" class="card-link">Leggi tutto</a>
            </div>
          </div>
          <div class="card col-12">
            <div class="card-body">
              <h5 class="card-title">Nuovi animali in arrivo!</h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Data articolo: 16/11/2025</h6>
              <p class="card-text">Da venerdì arriveranno a farci compagnia anche i cani Pippo e Pluto!</p>
              <a href="#" class="card-link">Leggi tutto</a>
            </div>
          </div>
        </div>
        

      </aside>
    </div>
  </div>
  <footer class="bg-dark text-light text-center p-3 font-monospace">
    &copy; Mattia Cavina, Matteo Grandini — Tutti i diritti riservati
  </footer>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>