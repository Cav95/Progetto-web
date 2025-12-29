<?php
require_once "../bootstrap.php";

$result["ok"] = false;

$result = $dbh->getPetList();

header("Content-Type: application/json");
echo json_encode($result);