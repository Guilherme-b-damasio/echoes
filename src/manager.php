<?php

require '../vendor/autoload.php';

use App\Controller\ControllerLogin;

if (isset($_GET['login'])) {
    login();
}

function login()
{
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($user) && !empty($pass)) {
        $controller = new ControllerLogin();
        $login = $controller->handle($user, $pass);
        
        if($login){
           $reponse = true;
        }else{
            $reponse = false;
        }
    }

    echo json_encode($reponse);
    return;
}
