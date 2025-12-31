<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (isset($_POST["email"]) && isset($_POST["password"])) {
  $temp = $dbh->getUserFromEmail($_POST["email"]);
  if (count($temp) == 0) {
    $result["msg"] = "Email o Password errati!";
  } else {
    $user = $temp[0];
    if ($user["Bannato"]) {
      $result["msg"] = "Email o Password errati!";
    } else {
      $isPasswordValid = password_verify($_POST["password"], $user["Password"]);
      if (!$isPasswordValid) {
        $result["msg"] = "Email o Password errati!";
      } else {
        registerLoggedUser($user["ID_Utente"], $user["Email"], $user["Nome"], $user["Cognome"], $user["Admin"]);
        $result["ok"] = true;
      }
    }
    
  }

}

header("Content-Type: application/json");
echo json_encode($result);