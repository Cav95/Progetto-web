<?php
session_start();
require_once "utils/functions.php";
require_once "db/database.php";
const PET_IMG_DIR = "./upload/pet/";
const DESIGN_IMG_DIR = "./upload/design/";
$dbh = new DatabaseHelper("localhost", "root", "", "unibo_pet_therapy", 3306);
