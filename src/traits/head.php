<?php

trait head {

    function includeScripts($arq){
        include (__DIR__ . "/view/includes/"  . $arq);
        return;
    }
}