<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
  $_SESSION["backURL"] = $_SERVER["REQUEST_URI"];
  header("Location: login.php");
  exit;
}

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Home | Unibo Pet Therapy";
if (isLoggedUserAdmin()) {
  $templateParams["nome"] = "admin-home.php";
  $templateParams["js"] = ["js/admin-home.js"];

  // Specific
  $templateParams["prenotazioni"] = $dbh->getPTSessionsFromDate('2026-01-15');
} else {
  $templateParams["nome"] = "user-home.php";
  $templateParams["js"] = ["js/user-home.js"];

  // Specific
  $templateParams["prenotazioni"] = $dbh->getNextPTSessionsFromUser($_SESSION["userid"]);
}



require "template/base.php";
