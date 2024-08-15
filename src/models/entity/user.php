<?php

namespace App\entity;


class user{

    public $id;
    public $login;
    public $name;
    public $email;
    public $phone;

    function __construct($user)
    {
        $this->id = $user->ID;
        $this->login = $user->login;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function getLogin(){
        return $this->login;
    }
}
