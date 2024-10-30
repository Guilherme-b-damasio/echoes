<?php

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerPlaylistPerso
{

    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($option, $user_id = null, $id_music = null, $playlist_id = null, $perso_id = null)
    {

        if ($option == 'update') {
            return $this->service->updateLikedPlaylist($user_id, $id_music);
        }
        if ($option == 'select') {
            return $this->service->searchPlaylist();
        }
        if ($option == 'songs') {
            return $this->service->searchMusicPerso($perso_id, null, $perso_id);
        }
        if ($option == 'delete') {
            return $this->service->deleteLikedPlaylist($user_id, $id_music);
        }
        if($option == 'next' || $option == 'prev'){
            return $this->service->searchMusicPerso($id_music, $option, $playlist_id);
        }
        
        if($option == 'set'){
            return $this->service->updatePersoPlaylist($perso_id, $id_music);
        }
        
    }
}
