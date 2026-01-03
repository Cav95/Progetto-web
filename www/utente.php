<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Utente | Unibo Pet Therapy";
$templateParams["nome"] = "user-form.php";
$templateParams["js"] = ["js/add-pet.js"];

//User feuture


if(isset($_REQUEST['id'])){
  $templateParams["user"] = $dbh->getUserFromID($_REQUEST['id'])[0];
  $templateParams["formaction"] = "Visualizza Utente";
  $templateParams["hidden"] = "visible";

}
else{
  $templateParams["user"] = $dbh->getUserFromId($_SESSION["userid"])[0];

  $templateParams["formaction"] = "Profilo";
  $templateParams["hidden"] = "hidden";
}
    
require "template/base.php";