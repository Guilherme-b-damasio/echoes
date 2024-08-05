<?php 

namespace App\Controller;
require '../vendor/autoload.php';
class ControllerPlayerMusic {

    public function handle(){
        include '../src/view/playerMusic.php';
    }
}