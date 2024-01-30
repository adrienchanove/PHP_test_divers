<?php

/**
 * Core configuration
 * Some basic definitions
 * and routes import
 */

session_start();


// Constant definitions
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('ROOT_PUBLIC', ROOT . DS . 'Public' . DS);
define('ROOT_CONF', ROOT . DS . 'Conf' . DS);
define('VIEWS_PATH', ROOT . DS . 'Views' . DS);
define('INCLUDE_PATH', ROOT . DS . 'Include' . DS);
define('CONTROLLERS_PATH', ROOT . DS . 'Controllers' . DS);
define('MODEL_PATH', ROOT . DS . 'Models' . DS);


// Autoload classes
spl_autoload_register(function ($className) {
    $parts = explode('\\', $className);
    $class = end($parts);
    array_pop($parts);
    $path = strtolower(implode(DS, $parts));
    // var_dump($path);
    $folderToCheck = array(
        INCLUDE_PATH,
        CONTROLLERS_PATH,
        MODEL_PATH
    );

    $found = false;
    foreach ($folderToCheck as $folder) {
        $pathController = $folder . $path . $class . '.php';
        
        if (file_exists($pathController)) {
            require_once($pathController);
            $found = true;
            break;
        }
    }

    if (!$found) {
        $string = "Impossible de charger la classe $className";
        foreach ($folderToCheck as $folder) {
            $string .= "\n$folder$path$class.php";
        }
        die($string);
    }
});


function view($view, $data = array())
{
    // Include view
    include_once VIEWS_PATH . $view . '.php';
}


// Include routes
require_once(ROOT_CONF . 'routes.php');

// Verification of the tables
User::verifySql();

// Launch router
Route::launch();

