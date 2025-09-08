<?php
session_start();
//BYOP!
// 1. Get controller & action from URL
$controllerName = $_GET['controller'] ?? 'auth';   // default to AuthController
$actionName = $_GET['action'] ?? 'landing';      // default action
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

$host = 'localhost';
$db = 'giftease';
$user = 'root';
$pass = '';
$pdo;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}


// 4. Create controller instance

$controller = new $controllerClass($pdo);

//YOU STOPPED HEREEE ##############

// 5. Call action if exists
if (method_exists($controller, $function)) {
    $controller->$function();
} else {
    die("Action $function not found in $controllerClass!");
}

