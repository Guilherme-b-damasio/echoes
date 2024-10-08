<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerMusic {
    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($name = null, $id = null, $time)
    {
        return $this->service->searchMusic($name, $id, $time);
    }
}