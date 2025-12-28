<?php
require_once "bootstrap.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_R"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $password_R = $_POST["password_R"];

  if ($password != $password_R) {
    $templateParams["errmsg"] = "Le password inserite non corrispondono!";
  } else {
    if ($dbh->doesUserExist($username)) {
      $templateParams["errmsg"] = "Questo username esiste già!";
    } else {
      $hash = password_hash($password, PASSWORD_ARGON2ID);
      $dbh->registerUser($username, $hash);
      $templateParams["infomsg"] = "Registrazione avvenuta con successo!";
    }
  }

}

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Registrati | Unibo Pet Therapy";
$templateParams["nome"] = "login-form.php";

// Specific
$templateParams["formaction"] = "Registrati";
    
require "template/base.php";