<section>
  <h2 class="text-center my-4 h2">Gestisci prenotazioni</h2>
  <div class="row row-cols-md-3 mb-5 gx-5 px-2 px-md-0 gy-3 align-items-center">
    <div class="col-12 col-md order-first order-md-2">
      <form action="#" method="POST">
        <div class="form-floating">
          <input type="date" name="data" class="form-control" id="data" placeholder="Data" value="<?php echo date("Y-m-d"); ?>" required>
          <label for="data" class="form-label">Data</label>
        </div>
        <input type="submit" hidden>
      </form>
    </div>
    <div class="col-6 col-md order-2 order-md-first">
      <div class="d-flex justify-content-end">
        <button class="btn btn-primary d-flex align-items-center gap-2" id="date-bwd">
          <svg class="icon" aria-hidden="true"><use href="#icon-arrow-left"></use></svg>
          Indietro
        </button>
      </div>
    </div>
    <div class="col-6 col-md order-last">
      <div class="d-flex justify-content-start">
        <button class="btn btn-primary d-flex align-items-center gap-2" id="date-fwd">
          Avanti
          <svg class="icon" aria-hidden="true"><use href="#icon-arrow-right"></use></svg>
        </button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col col-md-10 mx-md-0 mx-1">
      <div class="h3 text-center mt-3 mx-2 alert alert-info d-none" id="no-app-alert">
          Nessuna prenotazione per la data selezionata
      </div>
      <table class="table table-dark table-striped table-mobile-stack align-middle" id="app-table">
        <thead>
          <tr>
            <th scope="col" id="ora">Ora</th>
            <th scope="col" id="luogo">Luogo</th>
            <th scope="col" id="utente">Utente</th>
            <th scope="col" id="elimina"><span class="visually-hidden">Pulsanti elimina appuntamento</span></th>
          </tr>
        </thead>
        <tbody id="app-container">
          <!-- Appointments added with AJAX -->
        </tbody>
      </table>
    </div>
    <div class="col-md-1"></div>
  </div>
</section>

<!-- Bootstrap Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="modalLabel">Conferma cancellazione</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler cancellare questa sessione?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="button" id="delete-app-confirm" data-bs-dismiss="modal" class="btn btn-danger">Elimina</button>
      </div>
    </div>
  </div>
</div>


