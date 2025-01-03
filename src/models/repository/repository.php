<?php

namespace App\repository;

use App\config\db;
use Dotenv\Util\Str;
use PDO;
use PDOException;
use SebastianBergmann\Environment\Console;

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
    public function searchUserWithId(int $id)
    {
        $sql = "SELECT * FROM users WHERE users.ID = :user";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user', $id);

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
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

            $musics = $stmt->fetch(PDO::FETCH_OBJ);
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
                $sql .= " AND music.name LIKE :name or music.autor LIKE :name";
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
    public function searchMusicPerso($id)
    {
        try {

            $sql = "
        SELECT 
            music.ID AS ID, 
            music.name, 
            music.src, 
            music.image,
            music.autor
        FROM 
            music
        WHERE 1=1";

            $params = [];

            if (!empty($id)) {
                $sql .= " AND perso_id = :id";
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

    public function searchMusicLikedDistinct($id, $user)
    {
        try {

            $sql = "
        SELECT 
            music.ID AS musicID, 
            music.name, 
            music.src, 
            music.image,
            music.autor, 
            music.created_at AS music_created_at, 
            music.updated_at AS music_updated_at,
            likedplaylist.ID as ID
        FROM 
            music
        INNER JOIN 
            likedplaylist ON music.ID = likedplaylist.id_music
        WHERE ";


            $sql .= " likedplaylist.id_music = :id";
            $sql .= " AND likedplaylist.user_id = :user";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':user', $user);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            error_log('musics' . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log("Params: id = $id, user = $user", 3, 'C:\xampp\htdocs\echoes\logs\error.log');

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

    public function searchLikedMusicWithId($id, $user)
    {
        try {
            $sql = "SELECT ID as liked FROM likedplaylist WHERE id_music = :id AND user_id = :user";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function searchNextMusic($name, $id, $playlist_id)
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
                music.playlist_id = :playlist_id AND
                music.ID > :id 
            ORDER BY 
                music.ID ASC  
            LIMIT 1; 
            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
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

    public function searchNextMusicPerso($id, $perso_id)
    {
        $sql = "
            SELECT 
                music.ID AS ID, 
                music.name, 
                music.src, 
                music.image,
                music.autor, 
                music.created_at AS music_created_at, 
                music.updated_at AS music_updated_at
            FROM 
                music
            WHERE
                music.perso_id = :perso_id AND
                music.ID = (
                    SELECT MIN(ID)
                    FROM music
                    WHERE ID > :id and perso_id = :perso_id2
                );
            
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':perso_id', $perso_id, PDO::PARAM_INT);
        $stmt->bindParam(':perso_id2', $perso_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        error_log('musics' . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
        error_log('musics', 3, 'C:\xampp\htdocs\echoes\logs\error.log');

        return $result;
    }

    public function searchPrevMusicPerso($id, $perso_id)
    {
        $sql = "
    SELECT 
        music.ID AS ID, 
        music.name, 
        music.src, 
        music.image,
        music.autor, 
        music.created_at AS music_created_at, 
        music.updated_at AS music_updated_at
    FROM 
        music
    WHERE
        music.perso_id = :perso_id AND
        music.ID = (
            SELECT MAX(ID)
            FROM music
            WHERE ID < :id AND perso_id = :perso_id2
        );
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':perso_id', $perso_id, PDO::PARAM_INT);
        $stmt->bindParam(':perso_id2', $perso_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        // Log de depuração
        error_log("SQL: " . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
        error_log("Result: " . print_r($result, true), 3, 'C:\xampp\htdocs\echoes\logs\error.log');

        return $result;
    }

    public function teste($id, $perso_id)
    {
        $sql = "
                    SELECT * FROM music where ID = 1;
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        error_log('musics' . $sql, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
        error_log('musics', 3, 'C:\xampp\htdocs\echoes\logs\error.log');

        return $result;
    }


    public function searchPrevMusic($name, $id, $playlist_id)
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
                music.playlist_id = :playlist_id AND
                music.ID < :id  
            ORDER BY 
                music.ID DESC 
            LIMIT 1;
        ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
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


    public function searchLikedMusic($id, $user, $direction)
    {
        try {
            $operator = $direction === 'next' ? '>' : '<';
            $orderDirection = $direction === 'next' ? 'ASC' : 'DESC';

            $sql = "
            SELECT 
                likedplaylist.*, 
                music.ID AS music_id, 
                music.name, 
                music.src, 
                music.image,
                music.autor, 
                music.created_at AS music_created_at, 
                music.updated_at AS music_updated_at
            FROM 
                likedplaylist
            LEFT JOIN 
                music ON likedplaylist.id_music = music.ID
            WHERE
                likedplaylist.user_id = :user AND
                likedplaylist.ID = (
                    SELECT ID
                    FROM likedplaylist
                    WHERE user_id = :user AND likedplaylist.ID $operator :id
                    ORDER BY likedplaylist.ID $orderDirection
                    LIMIT 1
                );
        ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user', $user, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            // Log os valores para depuração
            error_log("Params: id = $id, user = $user", 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log("SQL Executed: " . $stmt->queryString, 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            error_log("Result: " . print_r($result, true), 3, 'C:\xampp\htdocs\echoes\logs\error.log');

            return $result ?: null;
        } catch (PDOException $e) {
            error_log("Error in searchLikedMusic: " . $e->getMessage(), 3, 'C:\xampp\htdocs\echoes\logs\error.log');
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

    public function createLikedPlaylist($userId)
    {
        $sql = $this->conn->prepare("INSERT INTO likedPlaylist(user_id) values (:userId)");
        $sql->bindParam(":userId", $userId);
        $sql->execute();

        return;
    }

    public function updateLikedPlaylist($user_id, $id_music)
    {
        $sql = $this->conn->prepare("INSERT INTO likedPlaylist(id_music, user_id) values (:id_music, :user_id)");
        $sql->bindParam(":id_music", $id_music);
        $sql->bindParam(":user_id", $user_id);
        return $sql->execute();
    }

    public function updatePersoPlaylist($perso_id, $id_music)
    {
        $sql = $this->conn->prepare("UPDATE music SET perso_id = :perso_id WHERE ID = :id_music");
        $sql->bindParam(":perso_id", $perso_id);
        $sql->bindParam(":id_music", $id_music);
        return $sql->execute();
    }


    public function selectLikedPlaylist($user_id)
    {
        try {
            $sql = "SELECT ID FROM likedPlaylist WHERE user_id = :user_id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result !== false && isset($result['ID'])) {
                return $result['ID'];
            } else {
                return 'teste';
            }
        } catch (PDOException $e) {
            // Handle SQL errors
            error_log('Database query failed: ' . $e->getMessage());
            return false;
        }
    }

    public function selectLikedPlaylistMusic($user_id)
    {
        try {
            $sql = "SELECT music.ID, music.name, music.src, music.image, music.autor, 
                        music.created_at AS music_created_at, 
                        music.updated_at AS music_updated_at
                FROM music
                INNER JOIN likedPlaylist ON music.ID = likedPlaylist.id_music
                WHERE likedPlaylist.user_id = :user_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $musics = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $musics;
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    public function selectLikedMusicWithID($user_id, $music)
    {
        try {
            $sql = "SELECT music.ID FROM music INNER JOIN likedPlaylist ON music.ID = likedPlaylist.id_music WHERE likedPlaylist.user_id = :user_id and likedPlaylist.id_music = :music";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':music', $music, PDO::PARAM_INT);
            $stmt->execute();

            $musics = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $musics;
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    public function deleteLikedPlaylistMusic($user_id, $music)
    {
        try {
            $sql = "DELETE FROM likedPlaylist WHERE likedPlaylist.user_id = :user_id and likedPlaylist.id_music = :music";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':music', $music, PDO::PARAM_INT);

            return $stmt->execute() ? true : false;
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function deletePersoPlaylistMusic($perso_id)
    {
        try {
            $sql = "DELETE FROM playlist_perso WHERE playlist_perso.ID = :perso_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":perso_id", $perso_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
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
    public function createPlaylist(int $user, String $playlist_name)
    {
        $stmt = $this->conn->prepare("INSERT INTO playlist_perso (user_id, name) VALUES (:user_id, :name)");
        $stmt->bindParam(":user_id", $user);
        $stmt->bindParam(":name", $playlist_name);

        return $stmt->execute();
    }

    public function searchPlaylist(int $user)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM playlist_perso WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $user, PDO::PARAM_INT);
            $stmt->execute();
            $playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
            error_log("Result: $user " . print_r($playlist, true), 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            return $playlist;
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }


    public function resetPassword(String $email)
    {
        try {
            $sql = "SELECT ID FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Result: $sql " . print_r($user, true), 3, 'C:\xampp\htdocs\echoes\logs\error.log');
            return $user;
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function resetPass($token)
    {
        // Verifica o token e se ele ainda é válido
        $stmt = $this->conn->prepare("SELECT user_id FROM password_resets WHERE token = :token AND expire_at >= :expire_at");
        $current_time = date("U");
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expire_at", $current_time);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function updateProfile(String $name, int $id, String $login, String $email, String $phone)
    {
        $sql = "SELECT * FROM users WHERE users.ID = :id";
        $response = [];

        try {

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result) {

                $stmt = $this->conn->prepare("UPDATE users SET name = :name, login = :login, email = :email, phone = :phone WHERE id = :id");

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":login", $login);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":id", $id);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {
                    $response['msg'] = "Usuário atualizado com sucesso";
                    $response['status'] = true;
                } else {
                    $response['msg'] = "Nenhuma alteração foi feita";
                    $response['status'] = false;
                }
            } else {
                $response['msg'] = "Usuário não encontrado";
                $response['status'] = false;
            }

            return $response;
        } catch (PDOException $e) {
            error_log("Error in updateProfile: " . $e->getMessage());
            return $response['msg'] = "Error in updateProfile: " . $e->getMessage();
        }
    }


    public function deleteProfile(int $id)
    {
        $sql = "SELECT * FROM users WHERE users.ID = :id";
        $response = [];

        try {

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if ($result) {

                $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");


                $stmt->bindParam(":id", $id);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {
                    $response['msg'] = "Usuário deletado com sucesso";
                    $response['status'] = true;
                    $response['redirect'] = 'login.php';
                } else {
                    $response['msg'] = "Nenhuma alteração foi feita";
                    $response['status'] = false;
                }
            } else {
                $response['msg'] = "Usuário não encontrado";
                $response['status'] = false;
            }

            return $response;
        } catch (PDOException $e) {
            error_log("Error in deleteProfile: " . $e->getMessage());
            return $response['msg'] = "Error in deleteProfile: " . $e->getMessage();
        }
    }


    public function confirmResetPass($new_password, $user_id)
    {

        // Atualiza a senha do usuário
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(":password", $new_password);
        $stmt->bindParam(":id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function deleteToken($token)
    {

        // Atualiza a senha do usuário
        $stmt = $this->conn->prepare("DELETE FROM  password_resets WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function selectLikedMusic($user_id, $music)
    {
        try {
            $sql = "SELECT music.ID
                FROM music
                INNER JOIN likedPlaylist ON music.ID = likedPlaylist.id_music
                WHERE likedPlaylist.user_id = :user_id AND likedPlaylist.id_music = :id_music";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':id_music', $music, PDO::PARAM_INT);
            $stmt->execute();

            $musics = $stmt->fetchAll(PDO::FETCH_NUM);
            return $musics != 0 ? $musics : '';
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
}
