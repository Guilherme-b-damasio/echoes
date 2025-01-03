<?php
use App\Controller\ControllerRegister;
session_start();
require '../vendor/autoload.php';

use App\Controller\ControllerLogin;
use App\Controller\ControllerReset;
use App\Controller\ControllerResetPassword;
use App\Controller\ControllerProfile;
use App\Controller\ControllerUser;

if (isset($_GET['login'])) {
    login();
}

if (isset($_GET['register'])) {
    registerUser();
}

if (isset($_GET['reset'])) {
    sendToken();
}

if (isset($_GET['resetpass'])) {
    resetPassword();
}

if (isset($_GET['updateProfile'])) {
    updateProfile();
}

if (isset($_GET['deleteProfile'])) {
    deleteProfile();
}

if (isset($_GET['searchUser'])) {
    searchUser();
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

function searchUser()
{
    $register = '';
    $user = unserialize($_SESSION['dataUser']);

    if (!empty($user)) {
        $controller = new ControllerUser();
        $register = $controller->handle($user->id);
    }

    echo json_encode($register);
    return;
}

function registerUser()
{
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    

    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($user) && !empty($pass)) {
        $controller = new ControllerRegister();
        $response = $controller->handle($name, $user, $email, $phone, $pass);
    }

    echo json_encode($response);
    return;
}

function sendToken()
{

    $email = isset($_POST['email']) ? $_POST['email'] : '';


    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($email)) {
        $controller = new ControllerReset();
        $response = $controller->handle($email);
    }

    echo json_encode($response);
    return;
}

function resetPassword()
{
    $response=[];
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
    $controller= new ControllerResetPassword;
    $response=$controller->handle($new_password, $token);
    echo json_encode($response);

    return;
}

function updateProfile()
{
    $option = 'update';
    $dataUser = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
    $response=['msg' => 'não alterado'];
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    

    // Verifica se os campos obrigatórios estão preenchidos
    if (!empty($login)) {
        $controller = new ControllerProfile();
        $response = $controller->handle($option, $dataUser->getId(), $name, $login, $email, $phone);
    }

    echo json_encode($response);
    return;
}

function deleteProfile(){
    $option = 'delete';
    $dataUser = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
    
    $response=['msg' => 'não alterado'];
    
    // Verifica se os campos obrigatórios estão preenchidos
    
        $response=['msg' => 'chegou aqui'];
        $controller = new ControllerProfile();
        $response = $controller->handle($option, $dataUser->getId());
    

    echo json_encode($response);
    return;
}