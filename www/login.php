<?php
require_once "bootstrap.php";

if (isUserLoggedIn()) {
  $backURL = $_SESSION["backURL"] ?? "prenotazioni.php";
  unset($_SESSION["backURL"]);
  header("Location: " . $backURL);
  exit;
}

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Login | Unibo Pet Therapy";
$templateParams["main"] = "form-login-registrazione.php";
$templateParams["js"] = ["login.js", "utils/alerts.js"];

// Specific
$templateParams["formaction"] = "Accedi";

require "template/base.php";