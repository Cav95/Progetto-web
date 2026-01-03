<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (!isUserLoggedIn()) {
  http_response_code(401);
  exit;
}

if (!isset($_REQUEST["action"])) {
  http_response_code(400);
  exit;
}

switch ($_REQUEST["action"]) {
  case 'modifica':
    if (isset($_POST["old-pwd"]) && isset($_POST["new-pwd"]) && isset($_POST["pwd-repeat"])) {
      $oldPassword = $_POST["old-pwd"];
      $newPassword = $_POST["new-pwd"];
      $newPasswordRepeat = $_POST["pwd-repeat"];
      if ($newPassword != $newPasswordRepeat) {
        $result["msg"] = "Le nuove password inserite non corrispondono";
      } else {
        $oldHash = $dbh->getUserFromEmail($_SESSION["email"])["Password"];
        if (!password_verify($oldPassword, $oldHash)) {
          $result["msg"] = "La password attuale inserita è sbagliata";
        } else {
          $newHash = password_hash($newPassword, PASSWORD_ARGON2ID);
          $r = $dbh->changeUserPassword($_SESSION["userid"], $newHash);
          if (!$r) {
            $result["msg"] = "Abbiamo riscontrato un problema inaspettato. Riprova più tardi.";
          } else {
            $result["msg"] = "Password modificata con successo!";
            $result["ok"] = true;
          }
        }
      }
    }
    break;

  case 'ban':
    if (!isLoggedUserAdmin()) {
      http_response_code(403);
      exit;
    }
    if (!isset($_REQUEST["userID"])) {
      http_response_code(400);
      exit;
    }
    $r = $dbh->userToggleBan($_REQUEST["userID"]);
    if (!$r) {
      $result["msg"] = "Errore imprevisto. Riprova più tardi.";
    } else {
      $result["ok"] = true;
    }
    break;
}

header("Content-Type: application/json");
echo json_encode($result);