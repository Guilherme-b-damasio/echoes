<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerMusicPlaylist {
    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($playlistID)
    {
       return $this->service->consultMusicPlaylist($playlistID);
    }
}