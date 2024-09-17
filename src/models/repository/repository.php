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
    public function searchMusic($name)
    {
        try {
            $name = "%$name%";

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
                music.name LIKE :name
            UNION
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
                music.playlist_id IN (
                    SELECT playlist_id
                    FROM music
                    WHERE name LIKE :name
                )
        ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return !empty($result) ? $result : null;
        } catch (PDOException $e) {
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
            // Envia os resultados como JSON
            return $playlist;
        } catch (PDOException $e) {
            return $e->getMessage();
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

    public function insertToken(int $user, String $token, int $expire)
    {
        // Salva o token e a validade no banco de dados
        $stmt = $this->conn->prepare("INSERT INTO password_resets (user_id, token, expire_at) VALUES (:user_id, :token, :expire_at)");
        $stmt->bindParam(":user_id", $user);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expire_at", $expire);
        $stmt->execute();

        return;
    }

    public function resetPassword(String $email)
    {
        // Verifica se o e-mail existe no banco de dados
        $sql="SELECT ID FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch();

        return $user;
    }

    public function resetPass($token){
        // Verifica o token e se ele ainda é válido
        $stmt = $this->conn->prepare("SELECT user_id FROM password_resets WHERE token = :token AND expire_at >= :expire_at");
        $current_time = date("U");
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expire_at", $current_time);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function confirmResetPass($new_password, $user_id){

        // Atualiza a senha do usuário
        $stmt = $this->conn->prepare("UPDATE users SET password = v WHERE id = :id");
        $stmt->bindParam(":password", $new_password);
        $stmt->bindParam(":id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }
}
