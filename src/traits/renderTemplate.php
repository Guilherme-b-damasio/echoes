<?php

namespace App\trait;

trait renderTemplate{
    public function render($template){
        $path = "../src/view/$template.php";
        include($path);
    }
}