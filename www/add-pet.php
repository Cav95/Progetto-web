<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Add pet | Unibo Pet Therapy";
$templateParams["nome"] = "pet-form.php";
$templateParams["js"] = ["js/add-pet.js"];

// Specific
$templateParams["formaction"] = "Registrati";
    
require "template/base.php";