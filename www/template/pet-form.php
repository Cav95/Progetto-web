<div class="row justify-content-center bg-body-tertiary">
  <div class="mb-1 mt-md-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form action="#" method="POST">
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
            <select id="spec-sel" class="form-select form-select-sm mb-3" aria-label="Small select example">
              <option selected><?php echo $templateParams["specificpet"]["Nomespecie"]; ?></option>
              <?php foreach ($templateParams["specie"] as $specie):
                ?>
                <option value="<?php echo $specie["ID_Specie"]; ?>" id="nomespecie"><?php echo $specie["Nomespecie"]; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <select id="razza-sel" class="form-select form-select-sm mb-3" aria-label="Small select example">
              <option selected><?php echo $templateParams["specificpet"]["Nomerazza"]; ?></option>
              <?php foreach ($templateParams["razza"] as $razza):
                ?>
                <option value="<?php echo $razza["ID_Razza"]; ?>" id="nomerazza">
                  <?php echo $razza["Nomespecie"] . "-" . $razza["Nomerazza"]; ?></option>
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
            <input class="form-control" type="file" id="pet-img"
              value="<?php echo $templateParams["specificpet"]["Immagine"]; ?>">
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="nome" class="form-control" id="descrizione-img" placeholder="Descrizione Immagine"
              value="<?php echo $templateParams["specificpet"]["DescrizioneImmagine"]; ?>" required>
            <label for="descrizione-img" class="form-label">Descrizione Immagine</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox"
              value="<?php echo $templateParams["specificpet"]["Disponibile"]; ?>" id="disponibile">
            <label class="form-check-label" for="checkDefault">
              Disponibile
            </label>
            <div>
            </div class="col-auto">

            <div class="d-flex justify-content-start col">
              <input type="submit" class="btn btn-primary my-3 px-3"
                value="<?php echo $templateParams["formaction"]; ?>" id="<?php echo $templateParams["specificpet"]["ID_Pet"]; ?>">
            </div>
            <div class="d-flex justify-content-end col">
              <input type="submit" class="btn btn-primary my-3 px-3 bg-warning" value="Elimina">
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>