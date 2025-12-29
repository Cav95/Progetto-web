<?php
require_once "bootstrap.php";

if (isUserLoggedIn()) {
  session_unset();
}
header("Location: login.php");
