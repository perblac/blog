<?php

class Article
{
    private $id, $title, $text, $dateArt, $author;

    // constructor
    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->title = $datos['title'];
        $this->text = $datos['text'];
        $this->dateArt = $datos['date'];
        $this->author = UserRepository::getUserById($datos['id_user']);
    }

    // métodos get
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function getText()
    {
        return $this->text;
    }

    public function getDate()
    {
        return $this->dateArt;
    }

    public function getAuthor() {
        return $this->author;
    }

    // métodos set
    public function setId($i)
    {
        $this->id = $i;
    }

    public function setTitle($t)
    {
        $this->title = $t;
    }

    public function setText($t)
    {
        $this->text = $t;
    }

    public function setDate($d)
    {
        $this->dateArt = $d;
    }
}
