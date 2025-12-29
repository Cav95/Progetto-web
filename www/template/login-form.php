<div class="row justify-content-center bg-body-tertiary">
  <div class="mb-1 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form action="#" method="POST">
          <?php if ($templateParams["formaction"] == "Registrati"): ?>
          <div class="form-floating mb-3">
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" autocomplete="given-name" required>
            <label for="nome" class="form-label">Nome</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="cognome" class="form-control" id="cognome" placeholder="Cognome" autocomplete="family-name" required>
            <label for="cognome" class="form-label">Cognome</label>
          </div>
          <?php endif; ?>
          <div class="form-floating mb-3">
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" autocomplete="email" required>
            <label for="email" class="form-label">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="<?php $templateParams["formaction"] == "Accedi" ? "current-password" : "new-password"; ?>" required>
            <label for="password" class="form-label">Password</label>
          </div>
          <?php if ($templateParams["formaction"] == "Registrati"): ?>
          <div class="form-floating mb-3">
            <input type="password" name="password-repeat" class="form-control" id="password-repeat" placeholder="Ripeti password" autocomplete="new-password" required>
            <label for="password-repeat" class="form-label">Ripeti password</label>
          </div>
          <?php endif; ?>
          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary my-3 px-3" value="<?php echo $templateParams["formaction"]; ?>">
          </div>
        </form>
      </div>
        <?php
        switch ($templateParams["formaction"]):
        case "Accedi":
        ?>
          <span>Non sei ancora registrato?</span>
          <a href="register.php" class="link-primary">Registrati</a>
        <?php
          break;
        case "Registrati":
        ?>
          <span>Sei già registrato?</span>
          <a href="login.php" class="link-primary">Accedi</a>
        <?php
          break;
        endswitch;
        ?>
    </div>
    
  </div>
</div>
