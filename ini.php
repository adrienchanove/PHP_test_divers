<?php
/**
 * This file is used to initialize the website
 * 
 * @version    1.0
 * @author     achanove
 */


// include ini.php a ajouter a chaque page
// include_once $_SERVER['DOCUMENT_ROOT']."\ini.php";

// Start the session if it hasn't already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// autoloader
spl_autoload_register(function ($class) {
    include_once $_SERVER['DOCUMENT_ROOT']."\include\\".$class.".php";
});
