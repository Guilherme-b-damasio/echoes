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

    public function registerUser(String $name, String $user, String $email, String $phone, String $pass)
    {
        $sql = "SELECT * FROM users WHERE users.login = :user";
        $response = [];

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user', $user);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$result) {
                $sql = $this->conn->prepare("INSERT INTO users(users.name, users.login, users.email, users.phone, users.password) values (?,?,?,?,?)");
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql->bindParam(1, $name);
                $sql->bindParam(2, $user);
                $sql->bindParam(3, $email);
                $sql->bindParam(4, $phone);
                $sql->bindParam(5, $pass);
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
            music.name, 
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
    public function searchMusic($name, $id)
    {
        try {

            $sql = "
        SELECT 
            music.ID AS ID, 
            music.name, 
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
            playlist ON music.playlist_id = playlist.ID
        WHERE 1=1";

            $params = [];

            if (!empty($name)) {
                $sql .= " AND music.name LIKE :name";
                $params[':name'] = "%$name%";
            }
            if (!empty($id)) {
                $sql .= " AND music.ID = :id";
                $params[':id'] = $id;
            }

            $stmt = $this->conn->prepare($sql);

            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return !empty($result) ? $result : null;
        } catch (PDOException $e) {
            error_log("SQL: " . $sql);
            error_log("Error in searchMusic: " . $e->getMessage());
            return null;
        }
    }
    
    public function consultPlaylist()
    {
        try {
            $sql = "SELECT * FROM playlist";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $playlist;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function searchNextMusic($name, $id)
    {
        try {
            $sql = "
            SELECT 
                music.ID AS ID, 
                music.name, 
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
                playlist ON music.playlist_id = playlist.ID
            WHERE
                music.ID = (
                    SELECT MIN(ID)
                    FROM music
                    WHERE ID > :id
                );
            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            error_log('musics' . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log('musics', 3, 'C:\xampp\htdocs\echoes\logs\error.log');

            return $result ? $result : null;
        } catch (PDOException $e) {
            error_log("SQL: " . $sql);
            error_log("Error in searchNextMusic: " . $e->getMessage());
            return null;
        }
    }
    public function searchPrevMusic($name, $id)
    {
        try {
            $sql = "
        SELECT 
            music.ID AS ID, 
            music.name, 
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
            playlist ON music.playlist_id = playlist.ID
        WHERE
            music.ID = (
                SELECT MAX(ID)
                FROM music
                WHERE ID < :id
            );
        ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ); // Usar fetch se você espera apenas um resultado

            // Log de depuração
            error_log("SQL: " . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log("Result: " . print_r($result, true), 3, 'C:\xampp\htdocs\echoes\logs\error.log');

            return $result ? $result : null;
        } catch (PDOException $e) {
            error_log("SQL: " . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log("Error in searchPrevMusic: " . $e->getMessage(), 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            return null;
        }
    }

    public function getMusicPlaylist($playlistID)
    {
        try {
            $sql = "SELECT 
            music.ID, 
            music.name, 
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
            playlist ON music.playlist_id = playlist.ID
        WHERE
            playlist.ID = $playlistID;
        ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $musics = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Envia os resultados como JSON
            return $musics;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
