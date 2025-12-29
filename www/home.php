<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
  $_SESSION["backURL"] = $_SERVER["REQUEST_URI"];
  header("Location: login.php");
  exit;
}

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Home | Unibo Pet Therapy";
$templateParams["nome"] = isLoggedUserAdmin() ? "admin-home.php" : "user-home.php";

require "template/base.php";
