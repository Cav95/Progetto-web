<?php

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}

function registerLoggedUser($username){
    $_SESSION["username"] = $username;
}
