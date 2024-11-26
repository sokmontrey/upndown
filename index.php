<?php
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

// Routing
$uri = $_SERVER['REQUEST_URI'];
// clean up the uri due to different environments path
$uri = explode('?', $uri)[0];
$uri = rtrim($uri, '/');
$uri = ltrim($uri, '/');
// [... , 'controller', 'action']
$uri = explode('/', $uri);
$controller_name = $uri[count($uri)-2];
$action_name = $uri[count($uri)-1];

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