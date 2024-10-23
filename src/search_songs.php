<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerMusic;
use App\Controller\ControllerMusicPlaylist;
use App\Controller\ControllerLikedPlaylist;
use App\entity\music;

$name = isset($_REQUEST["name"]) ? $_REQUEST["name"] :  null;
$user = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
$id = isset($_REQUEST["music"]) ? $_REQUEST["music"] :  null;
$option = isset($_REQUEST["option"]) ? $_REQUEST["option"] :  null;
$playlist_id = isset($_REQUEST["playlist_id"]) ? $_REQUEST["playlist_id"] :  null;
$time = '';

if(!empty($option)){
    $controller = new ControllerLikedPlaylist();
    $musics = $controller->handle($option,$user->getId() ,$id);

    echo json_encode($musics);
    return;
}

if (isset($_REQUEST['next'])) {
    $time = 'next';
    $controller = new ControllerMusic();
    $musics = $controller->handle(null, $id, $time, $playlist_id);

    echo json_encode($musics);
} else {
    if (isset($_REQUEST['prev'])) {
        $time = 'prev';
        $controller = new ControllerMusic();
        $musics = $controller->handle(null, $id, $time, $playlist_id);

        echo json_encode($musics);
    } else {
        $controller = new ControllerMusic();
        $musics = $controller->handle($name, $id, null);

        echo json_encode($musics);
    }
}
