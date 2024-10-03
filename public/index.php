<?php

use App\Controller\ControllerMain;

session_start();
require("../vendor/autoload.php");

// Verifica se é uma requisição AJAX
$isAjax = isset($_GET['ajax']) && $_GET['ajax'] === 'true';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$dataUser = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
$musicArray = isset($_SESSION['dataMusic']) ? unserialize($_SESSION['dataMusic']) : [];
$parsedUrl = parse_url($requestUri);
$queryString = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';

$controllerMethod = 'handle'; // Método padrão
$controller = new ControllerMain();

if ($requestMethod == 'GET') {
    if ($isAjax) {

        $page = $_GET['page'] ? $_GET['page'] : '';
        // Responder apenas com o conteúdo necessário para AJAX
        if ($page == 'login' || !isset($_SESSION['logado']) || !$_SESSION['logado']) {
            include '../src/view/login.php';
        } else {
            // Inclua apenas o conteúdo dinâmico para AJAX
            $controller->$controllerMethod($page);
        }
    } else {
        // Inclua o layout completo para requisições normais
        include('../src/view/header.php');
        if ($queryString == 'login' || !isset($_SESSION['logado']) || !$_SESSION['logado']) {
            include '../src/view/login.php';
        } else {
            echo '<div class="body-principal">';
            include('../src/view/includes/sidebar.php');
            $controller->$controllerMethod($queryString);
            include('../src/view/includes/player.php');
        }
       
        echo '</div>';
    }
} else {
    http_response_code(405);
    echo "Método não permitido";
}

?>

<script>

    window.onload = function(){ 
        localStorage.setItem('player', '');
    }
</script>
