<?php
use App\Controller\ControllerMain;

session_start();
require("../vendor/autoload.php");
include("../src/view/header.php");

$routes = include "../config/routes.php";
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

if (isset($requestMethod)) {
    $controllerMethod = $controllerInfo[1] ?? 'handle';
    $controller = new ControllerMain();

    if (method_exists($controller, $controllerMethod)) {
        $parsedUrl = parse_url($requestUri);
        $queryString = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
        $controller->$controllerMethod($queryString);
    } else {
        http_response_code(500);
        echo "500 Internal Server Error: Método '{$controllerMethod}' não encontrado na classe '{$controllerClass}'";
    }
} else {
    http_response_code(404);
    include "../src/view/404.php";
}
