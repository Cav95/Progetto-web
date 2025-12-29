<?php
require_once "../bootstrap.php";

if (isset($_POST["app-id"])) {
  $temp = $dbh->getUserOfSession($_POST["app-id"]);
  if (count($temp) == 1) {
    $app_owner = $temp[0];
    if ($app_owner["id_utente"] === $_SESSION["userid"]) {
      $dbh->deleteSession($_POST["app-id"]);
    }
  }

}
