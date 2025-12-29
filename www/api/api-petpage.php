<?php
require_once "../bootstrap.php";


$result = $dbh->getPetList();

for($i=0 ; $i<count($result); $i++){
    $result[$i]["Immagine"] = PET_IMG_DIR.$result[$i]["Immagine"];
}
header("Content-Type: application/json");
echo json_encode($result);