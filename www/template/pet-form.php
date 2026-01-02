<div class="row justify-content-center bg-body-tertiary">
  <div class="mb-1 mt-md-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form id="pet-form" action="#" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" autocomplete="given-name"
              value="<?php echo $templateParams["specificpet"]["Nomepet"]; ?>" required>
            <label for="nome" class="form-label">Nome</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="data" class="form-control" id="data" placeholder="Data"
              value="<?php echo $templateParams["specificpet"]["DataDiNascita"]; ?>" required>
            <label for="data" class="form-label">Data</label>
          </div>
          <div>
            <select id="spec-sel" name="nomespecie" class="form-select form-select-sm mb-3" aria-label="Small select example">
              <option selected>Specie</option>
            <?php foreach ($templateParams["specie"] as $specie): ?>
                <option value="<?php echo $specie["ID_Specie"]; ?>"
                  <?php if ($specie["Nomespecie"] === $templateParams["specificpet"]["Nomespecie"]) echo 'selected'; ?>>
                  <?php echo $specie["Nomespecie"]; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <select id="razza-sel" name="nomerazza" class="form-select form-select-sm mb-3" aria-label="Small select example">
              <option selected>Razza</option>
            <?php foreach ($templateParams["razza"] as $razza): ?>
                <option value="<?php echo $razza["ID_Razza"]; ?>"
                  <?php if ($razza["Nomerazza"] === $templateParams["specificpet"]["Nomerazza"]) echo 'selected'; ?>>
                  <?php echo $razza["Nomerazza"]; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-floating mb-3">
            <input type="text" name="descrizione" class="form-control" id="descrizione" placeholder="Descrizione"
              value="<?php echo $templateParams["specificpet"]["Descrizione"]; ?>" required>
            <label for="descrizione" class="form-label">Descrizione</label>
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Scegli Immagine Animale</label>
            <?php if (!empty($templateParams["specificpet"]["Immagine"])): ?>
              <div class="mb-2">
                <img src="<?php echo PET_IMG_DIR . $templateParams['specificpet']['Immagine']; ?>" alt="Current image" style="max-width:200px;">
              </div>
            <?php endif; ?>
            <input class="form-control" type="file" id="pet-img" name="img">
            <?php if (!empty($templateParams['specificpet']['Immagine'])): ?>
              <input type="hidden" id="existing-img" name="img" value="<?php echo $templateParams['specificpet']['Immagine']; ?>">
            <?php endif; ?>
          </div>

          <div class="form-floating mb-3">
            <input type="text" name="nome" class="form-control" id="descrizione-img" placeholder="Descrizione Immagine"
              value="<?php echo $templateParams["specificpet"]["DescrizioneImmagine"]; ?>">
            <label for="descrizione-img" class="form-label">Descrizione Immagine</label>
          </div>

          <div class="form-check" style="visibility: <?php echo $templateParams['hidden']; ?>">
            <input class="form-check-input" type="checkbox" name="disponibile" id="disponibile"
              <?php if (!empty($templateParams["specificpet"]["Disponibile"]) && $templateParams["specificpet"]["Disponibile"] === "yes") echo 'checked'; ?>>
            <label class="form-check-label" for="disponibile">Disponibile</label>
          </div>
          <div class="col-auto">

            <div class="d-flex justify-content-start col">
              <input type="submit" class="btn btn-primary my-3 px-3"
                value="<?php echo $templateParams["formaction"]; ?>"
                id="<?php echo $templateParams["specificpet"]["ID_Pet"]; ?>">
            </div>
            <div class="d-flex justify-content-end col">
              <input type="button" class="btn btn-danger delete-app" data-bs-toggle="modal"
                data-bs-target="#confirmModal" value="Elimina"
                data-id="<?php echo $templateParams["specificpet"]["ID_Pet"]; ?>">
            </div>
          </div>
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