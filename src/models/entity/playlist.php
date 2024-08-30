<?php

namespace App\entity;

class playlist
{
    public $name;

    public $id;

    function __construct($playlist)
    {
        if (is_object($playlist)) {
            $this->id = $playlist->ID ?? null;
            $this->name = $playlist->name ?? null;
        }
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getID()
    {
        return $this->id;
    }
}
