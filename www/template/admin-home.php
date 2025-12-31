<h2 class="text-center my-4 h2">Gestisci prenotazioni</h2>
<div class="row row-cols-md-3 mb-5 gx-5 px-2 px-md-0 gy-3 align-items-center">
  <div class="col-6 col-md order-2 order-md-1">
    <div class="d-flex justify-content-end">
      <button class="btn btn-primary d-flex align-items-center gap-2" id="date-fwd">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
        </svg>
        Indietro
      </button>
    </div>
  </div>
  <div class="col-12 col-md order-first order-md-2">
    <form action="#" method="POST">
      <div class="form-floating">
        <input type="date" name="data" class="form-control" id="data" placeholder="Data" value="<?php echo date("Y-m-d"); ?>" required>
        <label for="data" class="form-label">Data</label>
      </div>
    </form>
  </div>
  <div class="col-6 col-md order-last">
    <div class="d-flex justify-content-start">
      <button class="btn btn-primary d-flex align-items-center gap-2" id="date-bwd">
        Avanti
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
        </svg>
      </button>
      
    </div>
    
  </div>
</div>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col col-md-10 vstack mx-md-0 mx-1">
    <?php foreach ($templateParams["prenotazioni"] as $prenotazione): ?>
      <div class="card mb-3 px-2 bg-dark text-white" id="<?php echo "app-" . $prenotazione["id_prenotazione"]; ?>">
        <div class="card-body row">
          <div class="col-md-2 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16" aria-labelledby="ora-label">
              <title id="ora-label">Ora</title>
              <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
            </svg>
            <?php echo $prenotazione["ora"]; ?>
          </div>
          <div class="col-md-3 d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" aria-labelledby="posizione-label">
              <title id="posizione-label">Posizione</title>
              <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <?php echo $prenotazione["luogo"]; ?>
          </div>
          <div class="col-md d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16" aria-labelledby="user-label">
              <title id="user-label">Utente</title>
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
            </svg>
            <a href="user.php?id=<?php echo $prenotazione["utente"]; ?>" class="link-warning"><?php echo $prenotazione["email"]; ?></a>
          </div>
          <div class="col-md-2 d-flex align-items-center justify-content-end mt-md-0 mt-3">
            <button type="button" value="<?php echo $prenotazione["id_prenotazione"] ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">Elimina</button>
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
        <h1 class="modal-title fs-5" id="modalLabel">Conferma cancellazione</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler cancellare questa sessione?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="button" id="delete-app" data-bs-dismiss="modal" class="btn btn-danger">Elimina</button>
      </div>
    </div>
  </div>
</div>


