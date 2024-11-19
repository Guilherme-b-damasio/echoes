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

    public function handle($option, $id = null, $name = null, $login = null, $email = null, $phone = null)
    {
        if ($option == 'update') {
            return $this->service->updateProfile($name, $id, $login, $email, $phone);
        }
        if ($option == 'delete') {
            return $this->service->deleteProfile($id);
        }
    }
}
