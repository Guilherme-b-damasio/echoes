<?php

session_start();
require '../vendor/autoload.php';
use App\entity\music;
use App\Controller\ControllerPlayerMusic;

$controller = new ControllerPlayerMusic();
$musics = $controller->handle();
echo json_encode($musics);
