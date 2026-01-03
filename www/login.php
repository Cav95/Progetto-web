<?php
require_once "bootstrap.php";

if (isUserLoggedIn()) {
  $backURL = empty($_SESSION["backURL"]) ? "prenotazioni.php" : $_SESSION["backURL"];
  unset($_SESSION["backURL"]);
  header("Location: " . $backURL);
  exit;
}

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Login | Unibo Pet Therapy";
$templateParams["main"] = "main/form-login-registrazione.php";
$templateParams["js"] = ["js/login.js"];

// Specific
$templateParams["formaction"] = "Accedi";

require "template/base.php";