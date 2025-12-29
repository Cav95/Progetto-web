<?php

function isUserLoggedIn(): bool {
    return !empty($_SESSION['userid']);
}

function isLoggedUserAdmin(): bool {
    return isUserLoggedIn() && $_SESSION["admin"];
}

function registerLoggedUser($id, $email, $name, $surname, $admin): void {
    $_SESSION["userid"] = $id;
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["admin"] = $admin;
}
