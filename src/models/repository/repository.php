<?php

namespace App\repository;

use App\config\db;
use PDO;
use PDOException;

class repository
{
    public $conn;
    function __construct()
    {
        $db = new db();
        $this->conn = $db->conn();
    }

    public function searchUser(String $user, String $pass)
    {
        $sql = "SELECT * FROM users WHERE users.login = :user";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user', $user);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result && password_verify($pass, $result->password)) {
                return $result;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log("Error in searchUser: " . $e->getMessage());
            return null;
        }
    }
}
