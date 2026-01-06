<!DOCTYPE html>
<html lang="it" data-bs-theme="light">

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"/>
  <link rel="stylesheet" href="css/base.css"/>
  <?php
  foreach($templateParams["css"] ?? [] as $sheet):
  ?>
    <link rel="stylesheet" href="css/<?php echo $sheet; ?>"/>
  <?php
  endforeach;
  ?>
  <title><?php echo $templateParams["title"] ?? "Unibo Pet Therapy"; ?></title>
</head>

<body class="container-fluid bg-body p-0 overflow-x-hidden">
  <header class="bg-warning p-4">
    <?php require "navbar.php"; ?>
    <div class="row">
      <div class="col col-md-4">
        <h1 class="visually-hidden">Unibo Pet Therapy</h1>
        <a href="index.php"><img src="<?php echo DESIGN_IMG_DIR . "Titolo.png"; ?>" alt="" class="img-fluid w-100"/></a>
      </div>
      <div class="col-md-8"></div>
    </div>
  </header>
  <div class="row g-0 bg-body-tertiary">
    <div class="col-lg-9 col pb-4">
      <main>
        <?php
        if (isset($templateParams["main"])) {
          require "main/" . $templateParams["main"];
        }
        ?>
      </main>
    </div>
    <div class="col-lg-3 border-start border-2 px-3 pb-3">
      <aside>
        <section>
          <h2 class="text-center my-3 h4">Curiosità</h2>
          <div class="row px-2 g-3 pb-4">
            <?php foreach ($templateParams["curiosita"] ?? [] as $curiosita): ?>
              <article class="card col-12">
                <div class="card-body">
                  <h3 class="card-title h5"><?php echo $curiosita["titolo"]; ?></h3>
                  <p class="card-text"><?php echo $curiosita["descrizione"]; ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>
      </aside>
    </div>
  </div>
  <footer class="bg-dark text-light text-center p-3 font-monospace">
    <p class="my-2">&copy; Mattia Cavina, Matteo Grandini — Tutti i diritti riservati</p>
  </footer>

  <?php require "svg-sprites.php"; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <?php
  foreach($templateParams["js"] ?? [] as $script):
  ?>
    <script src="js/<?php echo $script; ?>"></script>
  <?php
  endforeach;
  ?>
</body>

</html>