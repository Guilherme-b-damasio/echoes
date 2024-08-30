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

                if ($sql) {
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

    public function consultMusic()
    {
        try {
            $sql = "SELECT 
            music.ID AS music_id, 
            music.name AS music_name, 
            music.src, 
            music.image,
            music.autor, 
            music.created_at AS music_created_at, 
            music.updated_at AS music_updated_at,
            playlist.ID AS playlist_id, 
            playlist.name AS playlist_name, 
            playlist.created_at AS playlist_created_at, 
            playlist.updated_at AS playlist_updated_at
        FROM 
            music
        INNER JOIN 
            playlist ON music.playlist_id = playlist.ID;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $musics = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Envia os resultados como JSON
            return $musics;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function consultPlaylist()
    {
        try {
            $sql = "SELECT * FROM playlist";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Envia os resultados como JSON
            return $playlist;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
