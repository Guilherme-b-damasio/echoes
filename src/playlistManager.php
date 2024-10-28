<?php

session_start();
require '../vendor/autoload.php';
use App\Controller\ControllerCreatePlaylist;
use App\entity\music;


$playlist_name = isset($_POST["playlist_name"]) ? $_POST["playlist_name"] :  null;
$option = isset($_GET["option"]) ? $_GET["option"] :  null;

if (!empty($playlist_name) && $option == 'save') {
    $response = [];
    $controller = new ControllerCreatePlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $response = $controller->handle( $user->id, $playlist_name);
    echo json_encode($response);
} 
