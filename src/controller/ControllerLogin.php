<?php 

namespace App\Controller;
require '../vendor/autoload.php';

class ControllerLogin {

    public function handle(){
        if($_GET['login']){
            
        }else{
            include '../src/view/login.php';
        }
    }
}