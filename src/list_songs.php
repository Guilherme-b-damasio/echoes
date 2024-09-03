<?php

session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerMusicPlaylist;
use App\entity\music;
use App\Controller\ControllerPlayerMusic;


$playlistID = isset($_GET["playlist"]) ? $_GET["playlist"] :  null;

if(!empty($playlistID)){
    $controller = new ControllerMusicPlaylist();
    $musics = $controller->handle($playlistID); 
}else{
    $controller = new ControllerPlayerMusic();
    $musics = $controller->handle();
}

echo json_encode($musics);
