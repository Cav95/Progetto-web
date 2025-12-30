<!DOCTYPE html>
<html lang="it" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <?php
  if(isset($templateParams["css"])):
    foreach($templateParams["css"] as $sheet):
  ?>
    <link rel="stylesheet" href="<?php echo $sheet; ?>">
  <?php
    endforeach;
  endif;
  ?>
  <title><?php echo $templateParams["title"]; ?></title>
</head>

<body class="container-fluid bg-body p-0 overflow-x-hidden">
  <header class="bg-warning p-4">
    <?php include "navbar.php"; ?>

    <div class="row">
      <div class="col col-md-4">
        <h1 class="visually-hidden">Unibo Pet Therapy</h1>
        <a href="index.php"><img src="<?php echo DESIGN_IMG_DIR . "Titolo.png"; ?>" alt="Unibo Pet Therapy" class="img-fluid w-100"></a>
      </div>
      <div class="col-md-8">

      </div>
    </div>

  </header>
  <div class="row g-0 bg-body-tertiary">
    <div class="col-lg-9 col">
      <main>
            <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
      </main>
    </div>
    <div class="col-lg-3 border-start border-2 px-3 pb-3">
      <aside>
        <h3 class="text-center my-3 h4">Curiosità</h3>
        <div class="row px-2 g-3">

          <?php foreach ($templateParams["curiosita"] as $curiosita): ?>
          <div class="card col-12">
            <div class="card-body">
              <h5 class="card-title"><?php echo $curiosita["titolo"]; ?></h5>
              <p class="card-text"><?php echo $curiosita["descrizione"]; ?></p>
            </div>
          </div>
          <?php endforeach; ?>
          
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
  <?php
  if(isset($templateParams["js"])):
    foreach($templateParams["js"] as $script):
  ?>
    <script src="<?php echo $script; ?>"></script>
  <?php
    endforeach;
  endif;
  ?>
</body>

</html>