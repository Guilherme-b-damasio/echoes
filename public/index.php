<?php

session_start();

use Src\controller\controllerMain;

require_once "../src/controller/controllerMain.php";

include("../src/view/header.php");

$routes = include "../config/routes.php";
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($routes["$requestMethod$requestUri"])) {
    $controller = explode('::', $routes["$requestMethod$requestUri"]);
        $controllerClass = $controller[0];

        // Inclui o arquivo do controlador, se necessário
        if (file_exists("../src/controller/{$controllerClass}.php")) {
            require_once "../src/controller/{$controllerClass}.php"; 
        } else {
            http_response_code(404);
            echo "404 Not Found: Controlador não encontrado";
            exit();
        }

        // Instancia o controlador e chama o método correspondente
        $controller = new controllerMain();
        $controller->handle();
   
} else {
    include "../src/view/404.php";
}
