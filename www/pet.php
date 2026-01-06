<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "I nostri Pet | Unibo Pet Therapy";
$templateParams["js"] = ["pet-show.js"];

require "template/base.php";
