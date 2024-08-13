<?php

return [
    'GET/echoes/public/index.php' => 'App\\Controller\\ControllerMain::handle',
    'GET/echoes/public/index.php?login' => 'App\\Controller\\ControllerLogin::handle',
    'POST/echoes/public/index.php' => 'App\\Controller\\ControllerLogin::handle',
    'POST/echoes/public/index.php?login' => 'App\\Controller\\ControllerLogin::handle'
];
