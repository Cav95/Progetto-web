<?php

function isUserLoggedIn(): bool
{
    return !empty($_SESSION['userid']);
}

function isLoggedUserAdmin(): bool
{
    return isUserLoggedIn() && $_SESSION["admin"];
}

function registerLoggedUser($id, $email, $name, $surname, $admin): void
{
    $_SESSION["userid"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["admin"] = $admin;
}

function uploadImage($path, $image): array
{
    $imageName = basename($image["name"]);
    $safeName = time() . "_" . preg_replace('/[^A-Za-z0-9._-]/', '_', $imageName);
    $fullPath = $path . $safeName;

    $maxKB = 4000;
    $acceptedExtensions = ["jpg", "jpeg", "png", "gif"];
    $result = 0;
    $msg = "";

    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "Il file caricato non è un'immagine! ";
    }

    //Controllo dimensione dell'immagine
    if ($image["size"] > $maxKB * 1000) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(", ", $acceptedExtensions);
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if (strlen($msg) == 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Errore nel caricamento dell'immagine.";
        } else {
            $result = 1;
            $msg = $safeName;
        }
    }
    return [$result, $msg];
}
