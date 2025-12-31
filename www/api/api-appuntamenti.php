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
    if (!isset($_REQUEST["app-id"])) {
      http_response_code(400);
      exit;
    }
    $app_owner = $dbh->getUserOfSession($_REQUEST["app-id"]);
    if ($app_owner != null) {
      if (!$_SESSION["admin"] && $app_owner["id_utente"] !== $_SESSION["userid"]) {
        http_response_code(403);
        exit;
      }
    }
    $result["ok"] = $dbh->deleteSession($_REQUEST["app-id"]);
    break;

  // Create a PT session
  case 'create':
    if (!isset($_REQUEST["app-date"]) || !isset($_REQUEST["app-time"])) {
      http_response_code(400);
      exit;
    }

    // Check if is a valid date
    $date = date_create_from_format('Y-m-d H:i', $_REQUEST["app-date"] . " " . $_REQUEST["app-time"]);
    if (!$date || $date < new DateTime()) {
      http_response_code(400);
      exit;
    }
    $result["ok"] = $dbh->addReservation($_SESSION["userid"], $_REQUEST["app-date"], $_REQUEST["app-time"]);
    $result["msg"] = $result["ok"]
      ? "Prenotazione aggiunta correttamente! <a href='home.php'>Vedi prenotazioni</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

  // Get available times for a specific date
  case 'time':
    if (!isset($_REQUEST["date"])) {
      http_response_code(400);
      exit;
    }
    $result["ok"] = true;
    $result["times"] = $dbh->getAvailableTimes($_REQUEST["date"]);
    break;

  // Get sessions from a specific date
  case 'get':
    if (!isset($_REQUEST["date"])) {
      http_response_code(400);
      exit;
    }
    $result["ok"] = true;
    $result["sessions"] = $dbh->getPTSessionsFromDate($_REQUEST["date"]);
    break;
}

header("Content-Type: application/json");
echo json_encode($result);