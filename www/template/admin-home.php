<h2 class="text-center my-4 h2">Gestisci prenotazioni</h2>
<div class="row row-cols-md-3 mb-5 gx-5 px-2 px-md-0 gy-3 align-items-center">
  <div class="col-6 col-md order-2 order-md-1">
    <div class="d-flex justify-content-end">
      <button class="btn btn-primary d-flex align-items-center gap-2" id="date-bwd">
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
      <button class="btn btn-primary d-flex align-items-center gap-2" id="date-fwd">
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
  <div class="col col-md-10 vstack mx-md-0 mx-1" id="app-container">
    <!-- Sessions added with AJAX -->
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


