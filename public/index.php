<?php
// display the errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/config/config.php';

// autoloader
spl_autoload_register(function ($className) {
    if (file_exists(__DIR__ . "/../app/Controllers/$className.php")) {
        require_once __DIR__ . "/../app/Controllers/$className.php";
    } elseif (file_exists(__DIR__ . "/../app/Models/$className.php")) {
        require_once __DIR__ . "/../app/Models/$className.php";
    } elseif (file_exists(__DIR__ . "/../app/Core/$className.php")) {
        require_once __DIR__ . "/../app/Core/$className.php";
    }
});

// router logic

// Geturl variable from .htaccess
$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';



$url = explode('/', $url);

// Determine the controller
$controllerName = ucfirst($url[0]);

if (file_exists(__DIR__ . "/../app/Controllers/$controllerName.php")) {
    require_once __DIR__ . "/../app/Controllers/$controllerName.php";
    unset($url[0]);
} else {
    require_once __DIR__ . "/../app/Controllers/Home.php";
    $controllerName = 'Home';
}

$currentController = new $controllerName();

// Determine the method
$methodName = isset($url[1])? $url[1] : 'index';

if(method_exists($currentController, $methodName)){
    unset($url[1]);
} else {
    die("Method $methodName does not exist in $controllerName");
}

$params = $url ? array_values($url) : [];


// RUN
call_user_func([$currentController, $methodName],$params);
