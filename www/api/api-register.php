<?php
require_once "../bootstrap.php";

$result["ok"] = false;

if (
  isset($_POST["nome"]) && 
  isset($_POST["cognome"]) && 
  isset($_POST["email"]) &&
  isset($_POST["password"]) &&
  isset($_POST["password-repeat"])
) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password_R = $_POST["password-repeat"];

  if ($password != $password_R) {
    $result["msg"] = "Le password inserite non corrispondono!";
  } else {
    if ($dbh->doesUserExist($email)) {
      $result["msg"] = "Un account con questa E-Mail esiste già! Vai al <a href='./login.php' class='link-primary'>login</a>";
    } else {
      $hash = password_hash($password, PASSWORD_ARGON2ID);
      $r = $dbh->registerUser($email, $_POST["nome"], $_POST["cognome"], $hash);
      if ($r) {
        $result["ok"] = true;
        $result["msg"] = "Registrazione avvenuta con successo! Vai al <a href='./login.php' class='link-primary'>login</a>";
      } else {
        $result["msg"] = "Abbiamo riscontrato un problema inaspettato. Riprova più tardi.";
      }
    }
  }
}

header("Content-Type: application/json");
echo json_encode($result);