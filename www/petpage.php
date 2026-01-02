<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Pet page - Unibo Pet Therapy";
$templateParams["js"] = array("js/petcard.js");

//$templateParams["js"][] = ["js/existent-pet.js"];

require "template/base.php";
