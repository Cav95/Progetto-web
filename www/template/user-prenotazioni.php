<section>
  <h2 class="text-center my-4 h2">Le tue prossime prenotazioni</h2>
  <div class="d-flex justify-content-center mb-4">
    <a href="nuova-prenotazione.php" class="btn btn-primary" id="new-app">Nuova prenotazione</a>
  </div>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col col-md-10 mx-md-0 mx-1" id="app-container">
      <?php if (count($templateParams["prenotazioni"]) == 0): ?>
        <div class="h3 text-center mt-3 mx-2 alert alert-info">Non hai nessuna prenotazione</div>
      <?php else: ?>
        <table class="table table-dark table-striped table-mobile-stack align-middle" id="app-table">
          <thead>
            <tr>
              <th scope="col" id="data">Data</th>
              <th scope="col" id="ora">Ora</th>
              <th scope="col" id="luogo">Luogo</th>
              <th scope="col" id="elimina"><span class="visually-hidden">Pulsanti disdici appuntamento</span></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($templateParams["prenotazioni"] as $prenotazione): ?>
              <tr id="<?php echo "app-" . $prenotazione["id_prenotazione"]; ?>">
                <td headers="data" data-label="Data">
                  <div class="d-flex align-items-center gap-2">
                    <svg class="icon" aria-hidden="true"><use href="#icon-calendar"></use></svg>
                    <?php echo $prenotazione["data"]; ?>
                  </div>
                </td>
                <td headers="ora" data-label="Ora">
                  <div class="d-flex align-items-center gap-2">
                    <svg class="icon" aria-hidden="true"><use href="#icon-clock"></use></svg>
                    <?php echo $prenotazione["ora"]; ?>
                  </div>
                </td>
                <td headers="luogo" data-label="Luogo">
                  <div class="d-flex align-items-center gap-2">
                    <svg class="icon" aria-hidden="true"><use href="#icon-position"></use></svg>
                    <?php echo $prenotazione["luogo"]; ?>
                  </div>
                </td>
                <td headers="elimina" class="d-flex align-items-center justify-content-center justify-content-md-end pt-3 pt-md-2">
                  <button type="button" value="<?php echo $prenotazione["id_prenotazione"] ?>" class="btn btn-danger delete-app" data-bs-toggle="modal" data-bs-target="#confirmModal">Disdici prenotazione</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
    <div class="col-md-1"></div>
  </div>
</section>

<!-- Bootstrap Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="modalLabel">Conferma annullamento prenotazione</h4>
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


