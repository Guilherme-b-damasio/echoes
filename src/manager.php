<?php
use App\Controller\ControllerRegister;
session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerLogin;

if (isset($_GET['login'])) {
    login();
}

if (isset($_GET['register'])) {
    registerUser();
}

function login()
{
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($user) && !empty($pass)) {
        $controller = new ControllerLogin();
        $register = $controller->handle($user, $pass);
        if($register){
           $response = true;
           $_SESSION['logado'] = true;
        }else{
            $response = false;
        }
    }

    echo json_encode($response);
    return;
}

function registerUser()
{
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($user) && !empty($pass)) {
        $controller = new ControllerRegister();
        $response = $controller->handle($user, $pass, $email);
    }

    echo json_encode($response);
    return;
}
