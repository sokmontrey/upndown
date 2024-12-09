<?php

define("BASE_PATH", rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'));

date_default_timezone_set('America/Toronto');

require_once 'app/core/Controller.php';
require_once 'app/core/Model.php';
require_once 'app/core/TimeFormatter.php';

spl_autoload_register(function ($class) {
    if (file_exists("app/controllers/{$class}.php")) {
        require_once "app/controllers/{$class}.php";
    } elseif (file_exists("app/models/{$class}.php")) {
        require_once "app/models/{$class}.php";
    } elseif (file_exists("app/core/{$class}.php")) {
        require_once "app/core/{$class}.php";
    }
});

if (session_status() == PHP_SESSION_NONE) session_start();
define("THEME", Session::getSession('theme') ?? 'light');
//define("THEME", 'light');

// -------------------------------- Routing --------------------------------

// process the uri
$uri = $_SERVER['REQUEST_URI'];
$uri = substr($uri, strlen(BASE_PATH) + 1); // remove base path
$uri = explode('?', $uri)[0]; // remove query string
$uri = ltrim(rtrim($uri, '/'), '/'); // remove trailing slashes
$uri = explode('/', $uri); // split the uri

$controller_name = $uri[0] === '' ? 'home' : $uri[0];
$action_name = $uri[1] ?? 'index';

// controller_name contains the word 'professor' redirect to prefessor.php
if ($controller_name === 'professor' || $controller_name === 'professor.php') {
    require_once 'professor.php';
    exit();
}

// format controller name to match the class name
$controller_name = ucfirst($controller_name) . 'Controller';
if (!file_exists("app/controllers/{$controller_name}.php")) {
    http_response_code(404);
    echo '404 Not Found';
    exit();
}
$controller = new $controller_name();
if (!method_exists($controller, $action_name)) {
    http_response_code(404);
    echo '404 Not Found';
    exit();
}
$controller->$action_name(); // call the action