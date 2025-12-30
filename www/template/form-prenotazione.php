<div class="row justify-content-center bg-body-tertiary">
  <div class="mt-md-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body">Nuova prenotazione</h2>
    <div class="card-body">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form action="#" method="POST">
          <div class="row row-cols-md-2 row-cols-1">
            <div class="col mb-3">
              <div class="form-floating">
                <input type="date" name="data" class="form-control" id="data" placeholder="Data" min="<?php echo date("Y-m-d"); ?>" required>
                <label for="data" class="form-label">Data</label>
              </div>
            </div>
            <div class="col mb-3">
              <div class="form-floating">
                <select name="ora" id="ora" class="form-select" disabled>
                  <option value="0" selected>Prima scegli una data</option>
                  <!-- Options added with JS -->
                </select>
                <label for="ora" class="form-label">Orario</label>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary mt-4 px-3" value="Conferma prenotazione">
          </div>
        </form>
    </div>
  </div>
</div>
