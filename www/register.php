<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Registrati | Unibo Pet Therapy";
$templateParams["nome"] = "form-login-registrazione.php";
$templateParams["js"] = ["js/register.js"];

// Specific
$templateParams["formaction"] = "Registrati";
    
require "template/base.php";