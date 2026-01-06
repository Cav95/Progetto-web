<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Registrati | Unibo Pet Therapy";
$templateParams["main"] = "form-login-registrazione.php";
$templateParams["js"] = ["register.js", "utils/alerts.js"];

// Specific
$templateParams["formaction"] = "Registrati";
    
require "template/base.php";