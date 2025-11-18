<div class="row justify-content-center bg-body-tertiary">
  <div class="my-5 col-md-6 p-3 card">
    <h2 class="text-center h1 mb-3 card-header bg-body"><?php echo $templateParams["formaction"]; ?></h2>
    <div class="card-body">
      <div class="mb-3">
        <?php if (isset($templateParams["errmsg"])): ?>
          <div class="alert alert-warning">
            <?php echo $templateParams["errmsg"]; ?>
          </div>
        <?php endif; if (isset($templateParams["infomsg"])): ?>
          <div class="alert alert-success">
            <?php echo $templateParams["infomsg"]; ?>
          </div>
        <?php endif; ?>
        <form action="#" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
            <label for="username" class="form-label">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password" class="form-label">Password</label>
          </div>
          <?php
          switch ($templateParams["formaction"]):
            case "Login":
          ?>
          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="remember" id="remember" checked disabled>
            <label for="remember" class="form-check-label">Ricordami</label>
          </div>
          <?php
          break;
          case "Registrati":
          ?>
          <div class="form-floating mb-3">
            <input type="password" name="password_R" class="form-control" id="password_R" placeholder="Ripeti password" required>
            <label for="password_R" class="form-label">Ripeti password</label>
          </div>
          <?php
          break;
          endswitch;
          ?>
          <button type="submit" class="btn btn-primary mb-3"><?php echo $templateParams["formaction"]; ?></button>
        </form>
      </div>
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center g-sm-2">
          <?php
          switch ($templateParams["formaction"]):
            case "Login":
          ?>
          <span>Non sei ancora registrato?</span>
          <a href="register.php" class="btn btn-secondary">Registrati</a>
          <?php
          break;
          case "Registrati":
          ?>
          <span>Sei già registrato?</span>
          <a href="login.php" class="btn btn-secondary">Login</a>
          <?php
          break;
          endswitch;
          ?>
      </div>
    </div>
    

  </div>
</div>
