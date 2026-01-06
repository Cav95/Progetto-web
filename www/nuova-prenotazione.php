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
$templateParams["title"] = "Nuova prenotazione | Unibo Pet Therapy";
$templateParams["main"] = "form-prenotazione.php";
$templateParams["js"] = ["nuova-prenotazione.js", "utils/alerts.js"];

require "template/base.php";
