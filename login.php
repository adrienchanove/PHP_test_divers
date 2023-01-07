<?php
// Page de login

// Start the session if it hasn't already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['loggedin'] = false;
}

// Get referer
$referer = $_SERVER['HTTP_REFERER']?? '';

echo $_SERVER['DOCUMENT_ROOT'];