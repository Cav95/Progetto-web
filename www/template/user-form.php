<div class="row justify-content-center bg-body-tertiary">
  <div class="mb-1 mt-md-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form id="pet-form" action="#" method="POST">
        <div class="d-flex align-items-center gap-2">
          <svg class="icon" aria-hidden="true"><use href="#icon-user"></use></svg>
          <p ><?php echo $templateParams["user"]["Nome"]." ". $templateParams["user"]["Cognome"]?> </p>
        </div>
        <div class="d-flex align-items-center gap-2">
          <svg class="icon" aria-hidden="true"><use href="#icon-user"></use></svg>
          <p ><?php echo $templateParams["user"]["Email"]?></p>
        </div>
        <?php if ($templateParams["formaction"] == "Profilo"): ?>
            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="<?php $templateParams["formaction"] == "Accedi" ? "current-password" : "new-password"; ?>" required/>
              <label for="password" class="form-label">Password</label>
            </div>           
            <div class="form-floating mb-3">
              <input type="password" name="password-repeat" class="form-control" id="password-repeat" placeholder="Ripeti password" autocomplete="new-password" required/>
              <label for="password-repeat" class="form-label">Ripeti password</label>
            </div>
              <div class="d-flex justify-content-end">
              <input type="submit" class="btn btn-primary my-3 px-3" value="Modifica"/>
            </div>
            <?php endif; ?>
            <?php if ($templateParams["formaction"] == "Visualizza Utente"): ?>
              <div class="d-flex justify-content-end">
              <input type="submit" class="btn btn-primary my-3 px-3 btn-danger" value="Banna Utente"/>
            </div>            
            <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Conferma cancellazione pet</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler cancellare questo animale?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <input type="submit" id="<?php echo $templateParams["specificpet"]["ID_Pet"]; ?>" class="btn btn-danger"
          value="Elimina" form="pet-form">
      </div>
    </div>
  </div>
</div>