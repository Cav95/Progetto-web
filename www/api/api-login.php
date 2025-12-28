<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (isset($_POST["email"]) && isset($_POST["password"])) {
  $hash = $dbh->getUserPasswordHash($_POST["email"]);
  $isPasswordValid = password_verify($_POST["password"], $hash);
  if (!$isPasswordValid) {
    $result["errorelogin"] = "Email o Password errati!";
  } else {
    registerLoggedUser($_POST["email"]);
    $result["ok"] = true;
  }
}

header("Content-Type: application/json");
echo json_encode($result);