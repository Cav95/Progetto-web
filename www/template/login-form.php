<div class="row justify-content-center bg-body-tertiary">
  <div class="my-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <div class="alert alert-warning d-none" id="alert-warning"></div>
        <div class="alert alert-success d-none" id="alert-success"></div>
        <form action="#" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
            <label for="email" class="form-label">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password" class="form-label">Password</label>
          </div>
          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary my-3 px-3" value="<?php echo $templateParams["formaction"]; ?>">
          </div>
        </form>
      </div>
        <?php
        switch ($templateParams["formaction"]):
          case "Login":
        ?>
        <span>Non sei ancora registrato?</span>
        <a href="register.php" class="link-primary">Registrati</a>
        <?php
        break;
        case "Registrati":
        ?>
        <span>Sei già registrato?</span>
        <a href="login.php" class="link-primary">Login</a>
        <?php
        break;
        endswitch;
        ?>
    </div>
    

  </div>
</div>
