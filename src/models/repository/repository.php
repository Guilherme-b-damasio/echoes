<?php

namespace App\repository;

use App\config\db;
use Dotenv\Util\Str;
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

    public function registerUser(String $user, String $pass, String $email)
    {
        $sql = "SELECT * FROM users WHERE users.login = :user";
        $response = [];

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user', $user);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$result) {
                $sql = $this->conn->prepare("INSERT INTO users(users.login, users.email, users.password) values (?,?,?)");
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql->bindParam(1, $user);
                $sql->bindParam(2, $email);
                $sql->bindParam(3, $pass);
                $sql->execute();

                if($sql){
                    $response['msg'] = "Usuário cadastrado com sucesso";
                    $response['status'] = true;
                }

            } else {
                $response['msg'] = "Já existe um usúario com esse nome";
                $response['status'] = false;
            }

            return $response;
        } catch (PDOException $e) {
            error_log("Error in searchUser: " . $e->getMessage());
            return null;
        }
    }

    public function consultMusic(){
        try {
            $sql = "SELECT src, name from music";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        
            $musics = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Envia os resultados como JSON
            return $musics;
            
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
}
