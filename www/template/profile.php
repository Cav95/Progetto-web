<section>
  <div class="row justify-content-center bg-body-tertiary">
    <div class="mb-1 mt-md-5 col-md-6 p-3 card">
      <h2 class="text-center h1 mb-1 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
      <div class="card-body">
        <?php if (!$templateParams["user"]): ?>
          <div class="alert alert-danger text-center">
            <strong>Utente inesistente!</strong>
          </div>
        <?php else: ?>
          <div class="d-flex align-items-center gap-2 mb-1 fs-5 fs-md-4">
            <svg class="icon" aria-label="Nome e Cognome"><use href="#icon-user"></use></svg>
            <?php echo $templateParams["user"]["Nome"] . " " . $templateParams["user"]["Cognome"]; ?>
          </div>
          <div class="d-flex align-items-center gap-2 mb-4 fs-5 fs-md-4">
            <svg class="icon" aria-label="Email"><use href="#icon-email"></use></svg>
            <?php echo $templateParams["user"]["Email"] ?>
          </div>
          <hr>
          <section>
            <?php if ($templateParams["formaction"] == "Profilo"): ?>
              <h3 class="h4 mb-3">Cambio password</h3>
            <?php endif; ?>
            <div class="alert alert-warning d-none" id="alert-warning"></div>
            <div class="alert alert-success d-none" id="alert-success"></div>
            <form action="#" method="POST">
              <?php 
              switch ($templateParams["formaction"]):
                case "Profilo":
              ?>
                  <div class="form-floating mb-3">
                    <input type="password" name="old-password" class="form-control" id="old-password" placeholder="Password attuale" autocomplete="current-password" required />
                    <label for="old-password" class="form-label">Password attuale</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="new-password" class="form-control" id="new-password" placeholder="Nuova password" autocomplete="new-password" required />
                    <label for="new-password" class="form-label">Nuova password</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="password-repeat" class="form-control" id="password-repeat" placeholder="Ripeti nuova password" autocomplete="new-password" required />
                    <label for="password-repeat" class="form-label">Ripeti nuova password</label>
                  </div>
                  <div class="d-flex justify-content-end">
                    <input type="submit" id="chg_pwd" class="btn btn-primary mt-3 px-3" value="Modifica password" />
                  </div>
              <?php
                  break;
                case "Visualizza Utente":
              ?>
                  <p>Questo utente è <strong><?php echo $templateParams["user"]["Bannato"] == 1 ? "bannato" : "abilitato" ?></strong></p>
                  <div class="d-flex justify-content-end">
                    <input type="submit" id="chg_ban" class="btn px-3 btn-danger" value="<?php echo $templateParams["user"]["Bannato"] ? "Abilita" : "Banna" ?> utente" data-userid="<?php echo $templateParams["user"]["ID_Utente"]; ?>" />
                  </div>
              <?php
                  break;
              endswitch;
              ?>
            </form>
          </section>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>