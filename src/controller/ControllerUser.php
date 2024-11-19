<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerUser
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($id)
    {
       return $this->service->searchUserWithID($id);
    }
}
