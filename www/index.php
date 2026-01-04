<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(5);

// Generic
$templateParams["title"] = "Unibo Pet Therapy";
$templateParams["main"] = "main/home.php";

require "template/base.php";
