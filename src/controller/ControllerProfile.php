<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerProfile
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($name, $login, $email, $phone, $id)
    {
       return $this->service->updateProfile($name, $login, $email, $phone, $id);
    }
}
