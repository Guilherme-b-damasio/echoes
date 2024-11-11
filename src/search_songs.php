<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerMusic;
use App\Controller\ControllerMusicPlaylist;
use App\Controller\ControllerLikedPlaylist;
use App\Controller\ControllerPlaylistPerso;
use App\entity\music;

$name = isset($_REQUEST["name"]) ? $_REQUEST["name"] :  null;
$user = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
$id = isset($_REQUEST["music"]) ? $_REQUEST["music"] :  null;
$option = isset($_REQUEST["option"]) ? $_REQUEST["option"] :  null;
$section = isset($_REQUEST["section"]) ? $_REQUEST["section"] :  null;
$playlist_id = isset($_REQUEST["playlist_id"]) ? $_REQUEST["playlist_id"] :  null;
$time = '';


if($section == 'perso'){
    $response = [];
    $controller = new ControllerPlaylistPerso();
    $response = $controller->handle($option, $user->getId(), $id, null, $playlist_id);
    echo json_encode($response);
    return;
}

if($section == 'liked'){
    $controller = new ControllerLikedPlaylist();
    $musics = $controller->handle($option,$user->getId() ,$id);

    echo json_encode($musics);
    return;
}


if (isset($_REQUEST['next'])) {
    $time = 'next';
    $controller = new ControllerMusic();
    $musics = $controller->handle($time, null, $id, $playlist_id);

    echo json_encode($musics);
} else {
    if (isset($_REQUEST['prev'])) {
        $time = 'prev';
        $controller = new ControllerMusic();
        $musics = $controller->handle($time, null, $id, $playlist_id);

        echo json_encode($musics);
    } else {
        $controller = new ControllerMusic();
        $musics = $controller->handle(null, $name, $id);

        echo json_encode($musics);
    }
}
