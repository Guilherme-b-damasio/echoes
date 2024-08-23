<?php

namespace App\Controller;

use App\trait\renderTemplate;

require '../vendor/autoload.php';
class ControllerMain
{

    use renderTemplate;

    public function handle($template)
    {
        if ($_SESSION['logado'] == 1) {
            if (!empty($template)) {
                $this->render($template);
            } else {
                include '../src/view/main.php';
            }
        } else {
            include '../src/view/login.php';
        }
    }
}
