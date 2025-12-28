<?php
require_once "bootstrap.php";

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Registrati | Unibo Pet Therapy";
$templateParams["nome"] = "login-form.php";
$templateParams["js"] = ["js/register.js"];

// Specific
$templateParams["formaction"] = "Registrati";
    
require "template/base.php";