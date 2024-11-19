<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerVerifyLiked
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($music_id, $user)
    {
       return $this->service->verifyLiked($music_id, $user);
    }
}
