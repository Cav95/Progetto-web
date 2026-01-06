<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
  $_SESSION["backURL"] = $_SERVER["REQUEST_URI"];
  header("Location: login.php");
  exit;
}

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Prenotazioni | Unibo Pet Therapy";
$templateParams["css"][] = "prenotazioni.css";

if (isLoggedUserAdmin()) {
  $templateParams["main"] = "admin-prenotazioni.php";
  $templateParams["js"] = ["admin-prenotazioni.js"];
} else {
  $templateParams["main"] = "user-prenotazioni.php";
  $templateParams["js"] = ["user-prenotazioni.js"];

  // Specific
  $templateParams["prenotazioni"] = $dbh->getNextPTSessionsFromUser($_SESSION["userid"]);
}

require "template/base.php";
