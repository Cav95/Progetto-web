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
    // TODO
    break;
}

header("Content-Type: application/json");
echo json_encode($result);