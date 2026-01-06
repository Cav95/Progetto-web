<?php
require_once "bootstrap.php";

if (!isLoggedUserAdmin()) {
  http_response_code(403);
  exit;
}

// Base
$templateParams["css"] = ["navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Aggiungi Pet | Unibo Pet Therapy";
$templateParams["main"] = "pet-form.php";
$templateParams["js"] = ["manage-pet.js", "utils/alerts.js"];

//Pet feuture
$templateParams["specie"] = $dbh->getSpecies();
$templateParams["razza"] = $dbh->getRaces();

if(isset($_REQUEST['pet-id'])){
  $templateParams["formaction"] = "Modifica";
  $templateParams["hidden"] = "visible";

  $temp= $dbh->getSinglePet($_REQUEST['pet-id']);
  $templateParams["specificpet"]["ID_Pet"] = $temp[0]["ID_Pet"];
  $templateParams["specificpet"]["Nomepet"] = $temp[0]["Nomepet"];
  $templateParams["specificpet"]["DataDiNascita"] = $temp[0]["DataDiNascita"];
  $templateParams["specificpet"]["Nomespecie"] = $temp[0]["Nomespecie"];  
  $templateParams["specificpet"]["Nomerazza"] = $temp[0]["Nomerazza"];
  $templateParams["specificpet"]["Descrizione"] = $temp[0]["Descrizione"];
  $templateParams["specificpet"]["Immagine"] = $temp[0]["Immagine"];
  $templateParams["specificpet"]["DescrizioneImmagine"] = $temp[0]["DescrizioneImmagine"];
  $templateParams["specificpet"]["Disponibile"] = $temp[0]["Disponibile"] == 1? "yes" : "no";

}
else{
  $templateParams["formaction"] = "Aggiungi";
  $templateParams["hidden"] = "hidden";
  
  $templateParams["specificpet"]["ID_Pet"] = ""; 
  $templateParams["specificpet"]["Nomepet"] = ""; 
  $templateParams["specificpet"]["DataDiNascita"] = ""; 
  $templateParams["specificpet"]["Nomespecie"] = "";    
  $templateParams["specificpet"]["Nomerazza"] = "";   
  $templateParams["specificpet"]["Descrizione"] = ""; 
  $templateParams["specificpet"]["Immagine"] = ""; 
  $templateParams["specificpet"]["DescrizioneImmagine"] = "";
}
    
require "template/base.php";