<?php

namespace App\entity;

class music
{
    public $name;
    public $autor;
    public $src;
    public $id;

    function __construct($music)
    {
        if (is_object($music)) {
            $this->id = $music->ID ?? null;
            $this->autor = $music->autor ?? null;
            $this->name = $music->name ?? null;
            $this->src = $music->src ?? null;
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function getAutor()
    {
        return $this->autor;
    }
    public function getSrc()
    {
        return $this->src;
    }
    
    public function getID()
    {
        return $this->id;
    }
}
