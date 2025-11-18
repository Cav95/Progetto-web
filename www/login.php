<?php
require_once "bootstrap.php";
require_once "navbar.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $hash = $dbh->getUserPasswordHash($_POST["username"]);
    $isPasswordValid = password_verify($_POST["password"], $hash);
    if (!$isPasswordValid) {
        $templateParams["errmsg"] = "Username o password sbagliati!";
    } else {
      //if ($_POST["remember"]) {
        registerLoggedUser($_POST["username"]);
      //}
      header("Location: index.php");
      exit;
    }
}

if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

$templateParams["title"] = "Login | Unibo Per Therapy";
$templateParams["formaction"] = "Login";
$templateParams["nome"] = "login-form.php";
    
require "template/base.php";