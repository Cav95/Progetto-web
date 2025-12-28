<?php
require_once "bootstrap.php";

if (isUserLoggedIn()) {
  header("Location: index.php"); // TODO Change to home.php
  exit;
}

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Login | Unibo Pet Therapy";
$templateParams["nome"] = "login-form.php";
$templateParams["js"] = ["js/login.js"];

// Specific
$templateParams["formaction"] = "Accedi";

require "template/base.php";