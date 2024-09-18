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

    public function handle($new_password, $token)
    {
       return $this->service->resetPass($new_password, $token);
    }
}
