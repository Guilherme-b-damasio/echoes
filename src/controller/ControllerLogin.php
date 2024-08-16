<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerLogin
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($user, $pass)
    {
       return $this->service->searchUser($user, $pass);
    }
}
