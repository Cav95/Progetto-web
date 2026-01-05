<?php
require_once "../bootstrap.php";


$result["pet"]= $dbh->getPetList();

for($i=0 ; $i<count($result["pet"]); $i++){
    $result["pet"][$i]["Immagine"] = PET_IMG_DIR.$result["pet"][$i]["Immagine"];
}
    $result["islogedin"] = isUserLoggedIn();
   $result["isadmin"] = isLoggedUserAdmin();

header("Content-Type: application/json");
echo json_encode($result);