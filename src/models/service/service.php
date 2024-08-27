<?php

namespace App\Service;

use App\Controller\ControllerMain;
use App\repository\repository;
use App\entity\user;
use App\entity\music;

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

    public function registerUser(String $user, String $pass, String $email)
    {
        $response = $this->repo->registerUser($user, $pass, $email);
        return $response;
        
    }
    public function consultMusic()
    {
        $response = $this->repo->consultMusic();
    
        if (!empty($response)) {
            $musicArray = [];
    
            foreach ($response as $musicData) {
                $music = new Music($musicData);
                $musicArray[] = $music;
            }
    
            $_SESSION['dataMusic'] = serialize($musicArray);
        }
    
        return $response;
    }
    
}
