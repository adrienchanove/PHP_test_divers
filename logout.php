<?php
// LOGOUT.PHP
// Include ini.php file
require_once $_SERVER['DOCUMENT_ROOT']."/ini.php";

// Check if the user is logged in
if (Auth::isLogged()) {
    Auth::logout();
}

// Redirect to the home page
header("location: /");
