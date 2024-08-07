<?php 

namespace App\Controller;
require '../vendor/autoload.php';

class ControllerLogin {

    public function handle(){
        include '../src/view/login.php';
    }
}