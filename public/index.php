<?php
use App\Controller\ControllerMain;

session_start();
require("../vendor/autoload.php");
include("../src/view/header.php");

$routes = include "../config/routes.php";
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$requestUri = rtrim($requestUri, '/');
$routeKey = "$requestMethod$requestUri";

if (isset($routes[$routeKey])) {
    $controllerInfo = explode('::', $routes[$routeKey]);
    $controllerClass = $controllerInfo[0];
    $controllerMethod = $controllerInfo[1] ?? 'handle';
    $controller = new $controllerClass();

    if (method_exists($controller, $controllerMethod)) {
        $controller->$controllerMethod();
    } else {
        http_response_code(500);
        echo "500 Internal Server Error: Método '{$controllerMethod}' não encontrado na classe '{$controllerClass}'";
    }
} else {
    http_response_code(404);
    include "../src/view/404.php";
}
