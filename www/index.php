<?php
require_once "bootstrap.php";

// Base
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

$templateParams["title"] = "Unibo Pet Therapy";
$templateParams["nome"] = "intro.php";

require "template/base.php";
