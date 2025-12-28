<?php
require_once "bootstrap.php";

if (isUserLoggedIn()) {
  header("Location: index.php"); // TODO Change to home.php
  exit;
}

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

$templateParams["title"] = "Login | Unibo Pet Therapy";
$templateParams["formaction"] = "Login";
$templateParams["nome"] = "login-form.php";
$templateParams["js"] = ["js/login.js"];
    
require "template/base.php";