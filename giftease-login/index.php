<?php
session_start();

// 1. Get controller & action from URL
$controllerName = $_GET['controller'] ?? 'auth';   // default to AuthController
$actionName = $_GET['action'] ?? 'handleLogin';      // default action
$urlParts = explode('/', trim($actionName, '/'));
$function = $urlParts[0];

// 2. Map controller name to class
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = "controllers/$controllerClass.php";

// 3. Load controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
    die("Controller $controllerClass not found!");
}

// 4. Create controller instance
$controller = new $controllerClass();

//YOU STOPPED HEREEE ##############

// 5. Call action if exists
if (method_exists($controller, $function)) {
    $controller->$function();
} else {
    die("Action $function not found in $controllerClass!");
}

