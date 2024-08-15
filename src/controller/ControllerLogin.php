<?php 

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerLogin {

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle(){
            include '../src/view/login.php';

            if(!empty($_POST['user']) && !empty($_POST['pass'])){
                $this->service->searchUser($_POST['user'], $_POST['pass']);
                
            }
            header("Location: index.php");
    }
}