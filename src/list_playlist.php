<?php

session_start();
require '../vendor/autoload.php';
use App\entity\playlist;
use App\Controller\ControllerPlaylist;

$controller = new ControllerPlaylist();
$playlist = $controller->handle();
echo json_encode($playlist);
