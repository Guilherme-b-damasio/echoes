<?php

session_start();
require '../vendor/autoload.php';
use App\Controller\ControllerSetPlaylist;
use App\entity\music;


if (isset($_REQUEST['set'])) {
    $controller = new ControllerSetPlaylist();
    $musics = $controller->handle();

    echo json_encode($musics);
} else {
    $controller = new ControllerSetPlaylist();
    $musics = $controller->handle($name, $id, null);

    echo json_encode($musics);
}
