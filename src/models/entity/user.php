<?php

namespace App\entity;

class user
{
    public $id;
    public $login;
    public $name;
    public $email;
    public $phone;

    function __construct($user)
    {
        if (is_object($user)) {
            $this->id = $user->ID ?? null;
            $this->login = $user->login ?? null;
            $this->name = $user->name ?? null;
            $this->email = $user->email ?? null;
            $this->phone = $user->phone ?? null;
        } else {
            // Log ou lidar com o erro: $user não é um objeto
            error_log('Expected an object but received: ' . print_r($user, true));
            throw new \InvalidArgumentException('Expected an object with properties ID, login, name, email, and phone.');
        }
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
}
