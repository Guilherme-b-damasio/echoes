<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerMusic;
use App\Controller\ControllerMusicPlaylist;
use App\entity\music;

$name = isset($_REQUEST["name"]) ? $_REQUEST["name"] :  null;
$id = isset($_REQUEST["music"]) ? $_REQUEST["music"] :  null;
$time = '';

if (isset($_REQUEST['next'])) {
    $time = 'next';
    $controller = new ControllerMusic();
    $musics = $controller->handle(null, $id, $time);

    echo json_encode($musics);
} else {
    if (isset($_REQUEST['prev'])) {
        $time = 'prev';
        $controller = new ControllerMusic();
        $musics = $controller->handle(null, $id, $time);

        echo json_encode($musics);
    } else {
        $controller = new ControllerMusic();
        $musics = $controller->handle($name, $id, null);

        echo json_encode($musics);
    }
}
