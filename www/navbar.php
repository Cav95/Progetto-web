<?php
require_once "bootstrap.php";

if (isset($_POST["logChange"])) {
    if (isUserLoggedIn()) {
      session_unset();
    }
    header("Location: login.php");
    exit;
}

$templateParams["navbtn"] = isUserLoggedIn() ? "Log out" : "Log in";
