<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(5);

// Generic
$templateParams["title"] = "Unibo Pet Therapy";
$templateParams["main"] = "home.php";

$templateParams["css"][] = "index.css";

require "template/base.php";
