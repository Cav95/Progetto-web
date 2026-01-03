<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (!isset($_REQUEST["action"])) {
  http_response_code(400);
  exit;
}

switch ($_REQUEST["action"]) {
  // Delete a PT session
  case 'modifica':
    if (
      isset($_POST["ID_User"]) &&
      isset($_POST["password"]) &&
      isset($_POST["password-repeat"])
    ) {
      $userid = $_POST["ID_User"];
      $password = $_POST["password"];
      $password_R = $_POST["password-repeat"];

      if ($password != $password_R) {
        $result["msg"] = "Le password inserite non corrispondono!";
      } else {

        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $r = $dbh->modifyUserPsw($userid, $hash);
        if ($r) {
          $result["ok"] = true;
          $result["msg"] = "Registrazione avvenuta con successo! Vai al <a href='./login.php' class='link-primary'>login</a>";
        } else {
          $result["msg"] = "Abbiamo riscontrato un problema inaspettato. Riprova più tardi.";
        }

      }
    }

  // Create a PT session
  case 'banna':
    if (
      !isset($_REQUEST["ID_User"])
    ) {
      http_response_code(400);
      exit;
    }

    $result["ok"] = $dbh->userBan(
      $_REQUEST["ID_User"]
    );
    $result["msg"] = $result["ok"]
      ? "Utente bannato correttamente! <a href='home.php'>Vai a Home</a>"

      : "Errore imprevisto. Riprova più tardi.";
    break;
}

header("Content-Type: application/json");
echo json_encode($result);