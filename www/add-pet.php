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
$templateParams["formaction"] = "Aggiungi";

//Pet feuture
$templateParams["specie"] = $dbh->getSpecie();
//$templateParams["js"][] = ["js/pet-race.js"];

    
require "template/base.php";