<?php
use App\Controller\ControllerMain;

session_start();
require("../vendor/autoload.php");
include("../src/view/header.php");
$routes = include "../config/routes.php";
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$dataUser = unserialize($_SESSION['dataUser']);
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
if (isset($requestMethod)) {
    $controllerMethod = $controllerInfo[1] ?? 'handle';
    $controller = new ControllerMain();

    if (method_exists($controller, $controllerMethod)) {
        $parsedUrl = parse_url($requestUri);
        $queryString = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';

        if($queryString == 'login' || !$_SESSION['logado']){
            include '../src/view/login.php';
        }else{
            echo '<div class="body-principal">';
            include('../src/view/includes/sidebar.php');
            $controller->$controllerMethod($queryString);
            include('../src/view/includes/player.php');
            echo '</div>';
        }
       
    } else {
        http_response_code(500);
        echo "500 Internal Server Error: Método '{$controllerMethod}' não encontrado na classe '{$controllerClass}'";
    }
} else {
    http_response_code(404);
    include "../src/view/404.php";
}
