<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerDeletePlaylist
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($perso_id)
    {
        return $this->service->deletePersoPlaylist( $perso_id);
    }
}
