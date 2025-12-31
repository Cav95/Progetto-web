<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (
  isset($_POST["nome"]) && 
  isset($_POST["datanascita"]) && 
  isset($_POST["nomespecie"]) &&
  isset($_POST["nomerazza"]) &&
  isset($_POST["descrizione"])&&
  isset($_POST["img"])&&
  isset($_POST["descrizioneimg"])
) {
  $nome = $_POST["nome"];
  $datanascita = $_POST["datanascita"];
  $nomespecie = $_POST["nomespecie"];
  $nomerazza = $_POST["nomerazza"];
  $descrizione = $_POST["descrizione"];
  $img =  $_POST["img"];
  $descrizioneimg = $_POST["descrizioneimg"];

      $r = $dbh->addPet($nome, $datanascita, $nomerazza, $descrizione, $img, $descrizioneimg);
      if ($r) {
        $result["ok"] = true;
        $result["msg"] = "L'aggiunta del Pet avvenuta con successo";
      } else {
        $result["msg"] = "Abbiamo riscontrato un problema inaspettato. Riprova più tardi.";
      }
    }

header("Content-Type: application/json");
echo json_encode($result);