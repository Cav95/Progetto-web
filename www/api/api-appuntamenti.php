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
  // Delete a PT session
  case 'delete':
    if (!isset($_REQUEST["app-id"])) {
      http_response_code(400);
      exit;
    }
    $app_owner = $dbh->getUserOfSession($_REQUEST["app-id"]);
    if ($app_owner == null) {
      break;
    }
    if (!$_SESSION["admin"] && $app_owner["id_utente"] !== $_SESSION["userid"]) {
      http_response_code(403);
      exit;
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
      ? "Prenotazione aggiunta correttamente! <a href='prenotazioni.php'>Vedi prenotazioni</a>"
      : "Errore imprevisto. Riprova più tardi.";
    break;

  // Get available times for a specific date
  case 'slots':
    if (!isset($_REQUEST["for-date"])) {
      http_response_code(400);
      exit;
    }
    $result["ok"] = true;
    $result["times"] = $dbh->getAvailableTimes($_REQUEST["for-date"]);
    break;

  // Get sessions from a specific date
  case 'get':
    if (!isset($_REQUEST["of-date"])) {
      http_response_code(400);
      exit;
    }

    $result["sessions"] = $dbh->getPTSessionsFromDate($_REQUEST["of-date"]);
    if (!$result["sessions"]) {
      break;
    }
    $result["min_date"] = min(array_column($result["sessions"], "data"));
    $result["max_date"] = max(array_column($result["sessions"], "data"));
    $result["ok"] = true;
    break;
}

header("Content-Type: application/json");
echo json_encode($result);