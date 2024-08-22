<?php

namespace App\Service;

use App\Controller\ControllerMain;
use App\repository\repository;
use App\entity\user;

class service
{
    protected $repo;
    protected $controllerMain;

    function __construct()
    {
        $this->repo = new repository();
        $this->controllerMain = new ControllerMain();
    }

    public function searchUser(String $user, String $pass)
    {
        $userData = $this->repo->searchUser($user, $pass);
        if(!empty($userData)){
            $user = new user($userData);
            $_SESSION['dataUser'] = serialize($user);
            return true;
        }

        return false;
        
    }
}
