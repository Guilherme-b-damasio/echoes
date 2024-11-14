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

    public function handle($option, $name = null, $login = null, $email = null, $phone = null, $id = null)
    {
        if ($option == 'delete') {
            return $this->service->updateProfile($name, $login, $email, $phone, $id);
        }
        if ($option == 'delete') {
            return $this->service->deleteProfile($id);
        }
    }
}
