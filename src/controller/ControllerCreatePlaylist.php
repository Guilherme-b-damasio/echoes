<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerCreatePlaylist
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($user_id, $playlist_name)
    {
        return $this->service->createPlaylist( $user_id, $playlist_name );
    }
}
