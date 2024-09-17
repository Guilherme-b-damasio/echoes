<?php 

namespace App\Controller;

use App\Service\service;

require '../vendor/autoload.php';

class ControllerPlaylist {
    protected $service;

    function __construct()
    {
        $this->service = new service();
    }

    public function handle($param)
    {
       return $this->service->consultPlaylist();
    }
}