<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerLikedPlaylist;
use App\entity\music;

$option = isset($_REQUEST['option']) ? $_REQUEST["option"] :  null;
$musicID = isset($_REQUEST['music']) ? $_REQUEST["music"] :  null;

if ($option == 'update') {
    $controller = new ControllerLikedPlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $playlist = $controller->handle('update', $user->id, $musicID);
    echo json_encode($playlist);
}

if ($option == 'delete') {
    $controller = new ControllerLikedPlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $playlist = $controller->handle('delete', $user->id, $musicID);
    echo json_encode($playlist);
}