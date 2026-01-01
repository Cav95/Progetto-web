<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (!isset($_REQUEST["action"])) {
  http_response_code(400);
  exit;
}

switch ($_REQUEST["action"]) {
  // Delete a PT session
  case 'delete':
    if (!isset($_REQUEST["pet-id"])) {
      http_response_code(400);
      exit;
    }
    $app_owner = $dbh->getUserOfSession($_REQUEST["pet-id"]);
    if ($app_owner != null) {
      if (!$_SESSION["admin"] && $app_owner["id_utente"] !== $_SESSION["userid"]) {
        http_response_code(403);
        exit;
      }
    }
    $result["ok"] = $dbh->deletePet($_REQUEST["pet-id"]);
    break;

  // Create a PT session
  case 'create':
    if (
      !isset($_REQUEST["nome"]) || !isset($_REQUEST["data"])
      || !isset($_REQUEST["nomerazza"])
      || !isset($_REQUEST["descrizione"])
      || !isset($_REQUEST["descrizioneimg"])
    ) {
      http_response_code(400);
      exit;
    }

    $imgName = null;
    if (isset($_FILES["img"]) && isset($_FILES["img"]["error"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
      $uploads_dir = __DIR__ . "/../upload/pet/";
      if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0755, true);
      }
      $original = basename($_FILES["img"]["name"]);
      $safeName = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', $original);
      $target = $uploads_dir . $safeName;
      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target)) {
        $imgName = $safeName;
      }
    } elseif (isset($_REQUEST["img"])) {
      $imgName = $_REQUEST["img"];
    }

    if ($imgName === null) {
      http_response_code(400);
      exit;
    }

    $result["ok"] = $dbh->addPet($_REQUEST["nome"], $_REQUEST["data"], $_REQUEST["nomerazza"], $_REQUEST["descrizione"], $imgName, $_REQUEST["descrizioneimg"]);
    $result["msg"] = $result["ok"]
      ? "Prenotazione aggiunta correttamente! <a href='home.php'>Vedi prenotazioni</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

  // Get available times for a specific date
  case 'razza':
    if (!isset($_REQUEST["nomespecie"])) {
      http_response_code(400);
      exit;
    }
    $result["razza"] = $dbh->getRaceFromSpecie($_REQUEST["id-specie"]);
    break;
}

header("Content-Type: application/json");
echo json_encode($result);