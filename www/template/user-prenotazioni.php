<h2 class="text-center my-4 h2">Le tue prossime prenotazioni</h2>
<div class="d-flex justify-content-center mb-4">
  <a href="nuova-prenotazione.php" class="btn btn-primary" id="new-app">Nuova prenotazione</a>
</div>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col col-md-10 vstack mx-md-0 mx-1">
    <?php foreach ($templateParams["prenotazioni"] as $prenotazione): ?>
      <div class="card mb-3 px-2 bg-dark text-white" id="<?php echo "app-" . $prenotazione["id_prenotazione"]; ?>">
        <div class="card-body row gap-md-4">
          <div class="col-md-2 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16" aria-labelledby="data-label">
              <title id="data-label">Data</title>
              <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
            </svg>
            <?php echo $prenotazione["data"]; ?>
          </div>
          <div class="col-md-2 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16" aria-labelledby="ora-label">
              <title id="ora-label">Ora</title>
              <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
            </svg>
            <?php echo $prenotazione["ora"]; ?>
          </div>
          <div class="col-md-2 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" aria-labelledby="posizione-label">
              <title id="posizione-label">Posizione</title>
              <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <?php echo $prenotazione["luogo"]; ?>
          </div>
          <div class="col-md d-flex align-items-center justify-content-end">
            <button type="button" value="<?php echo $prenotazione["id_prenotazione"] ?>" class="btn btn-danger delete-app" data-bs-toggle="modal" data-bs-target="#confirmModal">Disdici prenotazione</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="col-md-1"></div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Conferma annullamento prenotazione</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler disdire questo appuntamento?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="button" id="delete-app-confirm" data-bs-dismiss="modal" class="btn btn-danger">Disdici</button>
      </div>
    </div>
  </div>
</div>


