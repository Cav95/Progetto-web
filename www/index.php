<?php
require_once "bootstrap.php";
require_once "navbar.php";

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

$templateParams["title"] = "Home | Unibo Pet Therapy";
$templateParams["nome"] = "home.php";

require "template/base.php";
