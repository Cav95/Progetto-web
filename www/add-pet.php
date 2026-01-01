<?php
require_once "bootstrap.php";

// Base
$templateParams["css"] = ["css/navbar.css"];
$templateParams["curiosita"] = $dbh->getRandomFacts(3);

// Generic
$templateParams["title"] = "Add pet | Unibo Pet Therapy";
$templateParams["nome"] = "pet-form.php";
$templateParams["js"] = ["js/add-pet.js"];

//Pet feuture
$templateParams["specie"] = $dbh->getSpecie();
$templateParams["razza"] = $dbh->getRace();

if(isset($_REQUEST['pet-id'])){
  $templateParams["formaction"] = "Modifica";

  $temp= $dbh->getSinglePet($_REQUEST['pet-id']);
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

  $templateParams["specificpet"]["Nomepet"] = ""; 
  $templateParams["specificpet"]["DataDiNascita"] = ""; 
  $templateParams["specificpet"]["Nomespecie"] = "";    
  $templateParams["specificpet"]["Nomerazza"] = "";   
  $templateParams["specificpet"]["Descrizione"] = ""; 
  $templateParams["specificpet"]["Immagine"] = ""; 
  $templateParams["specificpet"]["DescrizioneImmagine"] = ""; 
  $templateParams["specificpet"]["Disponibile"] = ""; 
}
    
require "template/base.php";