<?php

session_start();
require '../vendor/autoload.php';
use App\Controller\ControllerCreatePlaylist;
use App\Controller\ControllerLoadSong;
use App\Controller\ControllerPlaylistPerso;
use App\Controller\ControllerDeletePlaylist;
use App\entity\music;


$playlist_name = isset($_REQUEST["playlist_name"]) ? $_REQUEST["playlist_name"] :  null;
$option = isset($_REQUEST["option"]) ? $_REQUEST["option"] :  null;
$perso_id = isset($_REQUEST["perso_id"]) ? $_REQUEST["perso_id"] :  null;
$music = isset($_REQUEST["music"]) ? $_REQUEST["music"] :  null;

if (!empty($playlist_name) && $option == 'save') {
    $response = [];
    $controller = new ControllerCreatePlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $response = $controller->handle( $user->id, $playlist_name);
    echo json_encode($response);
} 

if (!empty($perso_id) && $option == 'delete') {
    $response = [];
    $controller = new ControllerDeletePlaylist();;
    $response = $controller->handle( $perso_id);
    echo json_encode($response);
} 

if ($option == 'select'){
    $response = [];
    $controller = new ControllerPlaylistPerso();
    $response = $controller->handle($option);
    echo json_encode($response);
}

if ($option == 'songs'){
    $response = [];
    $controller = new ControllerPlaylistPerso();
    $perso_id = isset($_REQUEST["perso_id"]) ? $_REQUEST["perso_id"] :  null;
    $response = $controller->handle($option, null, null, null, $perso_id);
    echo json_encode($response);
}
if ($option == 'set'){
    $id_music = isset($_REQUEST["music"]) ? $_REQUEST["music"] :  null;
    $perso_id = isset($_REQUEST["perso_id"]) ? $_REQUEST["perso_id"] :  null;
    $response = [];
    $controller = new ControllerPlaylistPerso();
    $user = unserialize($_SESSION['dataUser']);
    $response = $controller->handle($option, $user->id, $id_music, null, $perso_id);
    echo json_encode($response);
}