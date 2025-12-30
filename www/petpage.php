<?php
require_once "bootstrap.php";

$templateParams["css"] = ["css/navbar.css"];

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

$templateParams["title"] = "Unibo Pet Therapy";
$templateParams["js"] = array("js/petcard.js");

require "template/base.php";
