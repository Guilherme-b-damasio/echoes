<?php

namespace App\repository;
use App\config\db;
use PDO;

class repository{
    public $conn;
    function __construct()
    {
        $db = new db();
        $this->conn = $db->conn();
    }

    public function searchUser(String $user, String $pass){
        $sql = "SELECT users.ID, users.login, users.password FROM users WHERE users.login=:user AND users.password=:pass";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}