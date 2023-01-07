<?php
/**
 * This file is used to initialize the website
 * 
 * @version    1.0
 * @author     achanove
 */


// include ini.php
include_once $_SERVER['DOCUMENT_ROOT']."\ini.php";

// autoloader
spl_autoload_register(function ($class) {
    include_once $_SERVER['DOCUMENT_ROOT']."\include\\".$class.".php";
});
