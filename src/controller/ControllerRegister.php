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

    public function handle($name, $user, $email, $phone, $pass)
    {
       return $this->service->registerUser($name, $user, $email, $phone, $pass);
    }
}
