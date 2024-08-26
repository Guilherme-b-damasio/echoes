<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerRegister
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($user, $pass, $email)
    {
       return $this->service->registerUser($user, $pass, $email);
    }
}
