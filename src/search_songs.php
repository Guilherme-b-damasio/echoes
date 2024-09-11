<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerMusic;
use App\Controller\ControllerMusicPlaylist;
use App\entity\music;

$name = isset($_GET["name"]) ? $_GET["name"] :  null;

$controller = new ControllerMusic();
$musics = $controller->handle($name);

echo json_encode($musics);
