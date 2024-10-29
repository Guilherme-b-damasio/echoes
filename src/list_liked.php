<?php

session_start();
require '../vendor/autoload.php';

use App\entity\playlist;
use App\Controller\ControllerLikedPlaylist;


$musicID = isset($_GET["music"]) ? $_GET["music"] :  null;

if (!empty($musicID)) {
    $controller = new ControllerLikedPlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $playlist = $controller->handle('select-music', $user->id, $musicID);
    echo json_encode($playlist);
} else {
    $controller = new ControllerLikedPlaylist();
    $user = unserialize($_SESSION['dataUser']);
    $playlist = $controller->handle('select', $user->id);
    echo json_encode($playlist);
}
