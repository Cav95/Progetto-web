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
$templateParams["title"] = "Utente | Unibo Pet Therapy";
$templateParams["main"] = "main/profile.php";
$templateParams["js"] = ["js/manage-profile.js"];

// Specific
if (!isLoggedUserAdmin() || !isset($_REQUEST["id"])) {
  $templateParams["user"]["Nome"] = $_SESSION["name"];
  $templateParams["user"]["Cognome"] = $_SESSION["surname"];
  $templateParams["user"]["Email"] = $_SESSION["email"];
  $templateParams["user"]["ID_Utente"] = $_SESSION["userid"];
  $templateParams["formaction"] = "Profilo";
} else {
  $templateParams["user"] = $dbh->getUserFromID($_REQUEST['id']);
  $templateParams["formaction"] = "Visualizza Utente";
}
    
require "template/base.php";