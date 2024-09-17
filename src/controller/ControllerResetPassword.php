<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerResetPassword
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($email)
    {
       return $this->service->resetPass($email);
    }
}
