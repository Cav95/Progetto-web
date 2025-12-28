<?php

function isUserLoggedIn(): bool {
    return !empty($_SESSION['email']);
}

function isLoggedUserAdmin(): bool {
    return isUserLoggedIn() && $_SESSION["admin"];
}

function registerLoggedUser($email, $name, $surname, $admin): void {
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["admin"] = $admin;
}
