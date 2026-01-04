<?php
require_once "../bootstrap.php";

if (!isUserLoggedIn()) {
  http_response_code(401);
  exit;
}

$result["ok"] = false;

if (!isset($_REQUEST["action"])) {
  http_response_code(400);
  exit;
}

switch ($_REQUEST["action"]) {
  case 'delete':
    if (!isLoggedUserAdmin()) {
      http_response_code(403);
      exit;
    }
    if (!isset($_REQUEST["ID_Pet"])) {
      http_response_code(400);
      exit;
    }
    $result["ok"] = $dbh->deletePet($_REQUEST["ID_Pet"]);
    $result["msg"] = $result["ok"]
      ? "Pet eliminato correttamente! <a href='petpage.php'>Vedi Pet</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

  case 'create':
    if (!isLoggedUserAdmin()) {
      http_response_code(403);
      exit;
    }
    if (
      !isset($_REQUEST["nome"]) || !isset($_REQUEST["data"])
      || !isset($_REQUEST["nomerazza"])
      || !isset($_REQUEST["descrizione"])
      || !isset($_REQUEST["descrizioneimg"])
    ) {
      http_response_code(400);
      exit;
    }

    [$r, $msg] = uploadImage(UPLOAD_PET_DIR, $_FILES["img"]);
    if ($r == 0) {
      $result["msg"] = $msg;
      break;
    }
    $imgName = $msg;

    $result["ok"] = $dbh->addPet(
      $_REQUEST["nome"],
      $_REQUEST["data"],
      $_REQUEST["nomerazza"],
      $_REQUEST["descrizione"],
      $imgName,
      $_REQUEST["descrizioneimg"]
    );
    $result["msg"] = $result["ok"]
      ? "Pet aggiunto correttamente! <a href='petpage.php'>Vedi Pet</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

  case 'modify':
    if (
      !isset($_REQUEST["nome"]) || !isset($_REQUEST["data"])
      || !isset($_REQUEST["nomerazza"])
      || !isset($_REQUEST["descrizione"])
      || !isset($_REQUEST["descrizioneimg"])
      || !isset($_REQUEST["disponibile"])
      || !isset($_REQUEST["ID_Pet"])
    ) {
      http_response_code(400);
      exit;
    }

    if(isset($_FILES["img"])) {
      [$r, $msg] = uploadImage(UPLOAD_PET_DIR, $_FILES["img"]);
      if ($r == 0) {
        $result["msg"] = $msg;
        break;
      }
      $imgName = $msg;
    } else if (isset($_REQUEST["oldimg"])) {
      $imgName = $_REQUEST["oldimg"];
    } else {
      http_response_code(400);
      exit;
    }

    $result["ok"] = $dbh->modifyPet(
      $_REQUEST["nome"],
      $_REQUEST["data"],
      $_REQUEST["nomerazza"],
      $_REQUEST["descrizione"],
      $imgName,
      $_REQUEST["descrizioneimg"],
      $_REQUEST["disponibile"],
      $_REQUEST["ID_Pet"]
    );
    $result["msg"] = $result["ok"]
      ? "Pet modificato correttamente! <a href='petpage.php'>Vedi Pet</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

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