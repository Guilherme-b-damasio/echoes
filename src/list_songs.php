<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerPlayerMusic;

$controller = new ControllerPlayerMusic();
$musics = $controller->handle();

echo json_encode($musics);