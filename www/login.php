<?php
require_once "bootstrap.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $hash = $dbh->getUserPasswordHash($_POST["username"]);
  $isPasswordValid = password_verify($_POST["password"], $hash);
  if (!$isPasswordValid) {
      $templateParams["errmsg"] = "Username o password sbagliati!";
  } else {
    registerLoggedUser($_POST["username"]);
    header("Location: index.php");
    exit;
  }
}

if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

$templateParams["title"] = "Login | Unibo Pet Therapy";
$templateParams["formaction"] = "Login";
$templateParams["nome"] = "login-form.php";
$templateParams["js"] = ["js/login.js"];
    
require "template/base.php";