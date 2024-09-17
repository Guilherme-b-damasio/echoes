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

    public function registerUser(String $name, String $user, String $email, String $phone, String $pass)
    {
        $response = $this->repo->registerUser($name, $user, $email, $phone, $pass);
        return $response;
    }

    public function consultMusicPlaylist($playlistID)
    {
        $response = $this->repo->getMusicPlaylist($playlistID);

        if (!empty($response)) {
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
    public function searchMusic($name)
    {
        $response = $this->repo->searchMusic($name);
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
                $mail->Username = 'gabriel_a_bruno@estudante.sesisenai.org.br';  // Seu endereço de e-mail
                $mail->Password = 'Gab@199800';  // Sua senha ou App Password do Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Configurações do e-mail
                $mail->setFrom('gabriel_a_bruno@estudante.sesisenai.org.br', 'Echoes');
                $mail->addAddress($email);

                // Usuário encontrado, gerar o token
                $token = bin2hex(random_bytes(50));  // Gera um token seguro
                $expire = date("U") + 3600;  // Token válido por 1 hora
                $result = [];

                $this->repo->insertToken($response['ID'], $token, $expire);

                // Cria o link de redefinição de senha
                $reset_link = "http://127.0.0.1/echoes/src/view/reset_password.php?token=" . $token;

                // Conteúdo do e-mail
                $mail->isHTML(true);
                $mail->Subject = 'Redefinição de Senha';
                $mail->Body    = 'Clique no link para redefinir sua senha...'.$reset_link;

                // Enviar o e-mail
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

    public function resetPass($token)
    {

        $result = $this->repo->resetPass($token);
        $response = [];

        if ($result) {
            $response['msg'] = "Senha redefinida com sucesso!";
        } else {
            $response['msg'] = "Token inválido ou expirado.";
        }
        return $response;
    }
}
