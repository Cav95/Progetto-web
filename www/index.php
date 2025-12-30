<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Unibo Pet Therapy";
$templateParams["nome"] = "intro.php";
$templateParams["css"][] = "css/index.css";

require "template/base.php";
