<?php 

namespace App\Controller;
require '../vendor/autoload.php';
class ControllerMain {

    public function handle(){
        include '../src/view/main.php';
    }
}