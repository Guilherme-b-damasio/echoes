<?php

namespace App\Service;

use App\Controller\ControllerMain;
use App\repository\repository;
use App\entity\user;
use App\entity\music;
use App\entity\playlist;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class service
{
    protected $repo;
    protected $controllerMain;

    function __construct()
    {
        $this->repo = new repository();
        $this->controllerMain = new ControllerMain();
    }

    public function searchUser(String $user, String $pass)
    {
        $userData = $this->repo->searchUser($user, $pass);
        if (!empty($userData)) {
            $user = new user($userData);
            $_SESSION['dataUser'] = serialize($user);


            return true;
        }

        return false;
    }

    public function searchUserWithID(int $id)
    {
        $userData = $this->repo->searchUserWithID($id);
        if (!empty($userData)) {
            $user = new user($userData);
            $_SESSION['dataUser'] = serialize($user);
            return $userData;
        }

        return false;
    }

    public function registerUser(String $name, String $user, String $email, String $phone, String $pass)
    {
        $response = $this->repo->registerUser($name, $user, $email, $phone, $pass);
        if (!empty($response['user_id'])) {
            $this->repo->createLikedPlaylist($response['user_id']);
        }
        return $response;
    }

    public function consultMusicPlaylist($playlistID)
    {
        $result = '';
        $count = 0;
        $dataUser = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
        $response = $this->repo->getMusicPlaylist($playlistID);

        if (!empty($response)) {
            if ($dataUser) {
                foreach ($response as $value) {
                    $result = $this->repo->selectLikedMusic($dataUser->id, $value->ID);
                    $response[$count]->liked = !empty($result) ? 'true' : 'false';
                    $count++;
                }
            }
            $_SESSION['dataMusic'] = serialize($response);
        }

        return $response;
    }
    public function consultMusic()
    {
        $response = $this->repo->consultMusic();

        if (!empty($response)) {
            $musicArray = [];

            foreach ($response as $musicData) {
                $music = new Music($musicData);
                $musicArray[] = $music;
            }

            $_SESSION['dataMusic'] = serialize($musicArray);
        }

        return $response;
    }
    public function searchMusic($name, $id, $time, $playlist_id)
    {

        header('Content-Type: application/json');
        if ($time == 'next') {
            $response = $this->repo->searchNextMusic($name, $id, $playlist_id);
            return $response;
        }

        if ($time == 'prev') {
            $response = $this->repo->searchPrevMusic($name, $id, $playlist_id);
            return $response;
        }

        if (empty($time)) {
            $response = $this->repo->searchMusic($name, $id);
            return $response;
        }
    }
    
    public function searchMusicPerso($id, $time, $perso_id)
    {

        header('Content-Type: application/json');
        if ($time == 'next') {
            $response = $this->repo->searchNextMusicPerso($id, $perso_id);
            return $response;
        }

        if ($time == 'prev') {
            $response = $this->repo->searchPrevMusicPerso($id, $perso_id);
            return $response;
        }

        if (empty($time)) {
            $response = $this->repo->searchMusicPerso($id);
            return $response;
        }
    }

    public function searchMusicLiked($id, $user)
    {
        $response = $this->repo->searchMusicLikedDistinct($id, $user);
        return $response;
    }

    public function selectLikedNextPrevMusics($id, $option, $user)
    {
        header('Content-Type: application/json');
        $response = $this->repo->searchLikedMusic($id, $user, $option);
        return $response;
    } 
    
    public function verifyLiked($music_id, $user)
    {
        header('Content-Type: application/json');
        $response = $this->repo->searchLikedMusicWithId($music_id, $user);
        return $response;
    }

    public function consultPlaylist()
    {
        $response = $this->repo->consultPlaylist();

        if (!empty($response)) {
            $playlistArray = [];

            foreach ($response as $list) {
                $playlist = new playlist($list);
                $playlistArray[] = $playlist;
            }

            $_SESSION['dataPlaylist'] = serialize($playlistArray);
        }

        return $response;
    }

    public function updateLikedPlaylist($user_id, $id_music)
    {
        $return = [];

        $result = $this->repo->selectLikedMusicWithID($user_id, $id_music);
        if ($result) {
            $return['type'] = 'error';
            return $return;
        }

        $response = $this->repo->updateLikedPlaylist($user_id, $id_music);
        if ($response) {
            $return['type'] = 'success';
        } else {
            $return['type'] = 'error';
        }
        return $return;
    }

    public function updatePersoPlaylist($perso_id, $id_music)
    {
        $return = [];
        $response = $this->repo->updatePersoPlaylist($perso_id, $id_music);
        if ($response) {
            $return['type'] = 'success';
        } else {
            $return['type'] = 'error';
        }
        return $return;
    }

    public function selectLikedPlaylist($user_id)
    {
        $response = [];
        $consult = [];

        $consult = $this->repo->selectLikedPlaylistMusic($user_id);
        $_SESSION['dataLikedSongs'] = serialize($consult);

        return $consult;
    }

    public function deleteLikedPlaylist($user_id, $id_music)
    {
        $consult = [];

        $consult = $this->repo->deleteLikedPlaylistMusic($user_id, $id_music);
        return $consult;
    }
     public function deletePersoPlaylist($perso_id)
    {
        $consult = [];

        $consult = $this->repo->deletePersoPlaylistMusic($perso_id);

        return $consult;
    }
    
    public function createPlaylist($user_id, $playlist_id)
    {
        $response = [];
        $result = $this->repo->createPlaylist($user_id, $playlist_id);
        if($result){
            $response['msg'] = 'Incluido com sucesso';
            $response['type'] = 'sucess';
        }else{
            $response['msg'] = 'Não foi possivel criar a playlist';
            $response['type'] = 'error';
        }
        return $response;
    }
    
    public function searchPlaylist()
    {
        $response = [];
        $dataUser = isset($_SESSION['dataUser']) ? unserialize($_SESSION['dataUser']) : [];
        $user_id = $dataUser->getId();
        $response = $this->repo->searchPlaylist($user_id);
        return $response;
    }

    public function resetPassword(String $email)
    {
        $response = $this->repo->resetPassword($email);

        if ($response) {

            $mail = new PHPMailer(true);

            try {
                // Configurações do servidor
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gabriel_a_bruno@estudante.sesisenai.org.br';
                $mail->Password = 'Gab@199800';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações do e-mail
                $mail->setFrom('gabriel_a_bruno@estudante.sesisenai.org.br', 'Echoes');
                $mail->addAddress($email);

                // Usuário encontrado, gerar o token
                $token = bin2hex(random_bytes(50));
                $expire = date("U") + 3600;
                $result = [];

                $this->repo->insertToken($response['ID'], $token, $expire);

                $reset_link = "http://127.0.0.1/echoes/src/view/reset_password.php?token=" . $token;

                $mail->isHTML(true);
                $mail->Subject = 'Redefinição de Senha';
                $mail->Body    = 'Clique no link para redefinir sua senha...' . $reset_link;

                $mail->send();
                $result['msg'] = "E-mail de recuperação enviado!";
            } catch (Exception $e) {
                $result['msg'] = "Erro ao enviar o e-mail.";
            }
        } else {
            $result['msg'] = "E-mail não encontrado.";
        }
        return $result;
    }

    public function resetPass($new_password, $token)
    {

        $result = $this->repo->resetPass($token);
        $response = [];

        if ($result) {

            $this->repo->confirmResetPass($new_password, $result['user_id']);

            $this->repo->deleteToken($token);
            $response['msg'] = "Senha redefinida com sucesso!";
            $response['type'] = "success";
        } else {
            $response['msg'] = "Token inválido ou expirado.";
            $response['type'] = "erro";
        }
        return $response;
    }

    public function updateProfile(String $name, String $login, String $email, String $phone, int $id)
    {

        $response = $this->repo->updateProfile($name, $login, $email, $phone, $id);
        
        return $response;
    }

}

