<?php

class Comment{
    private $id, $text, $id_article, $id_user, $dateCom, $deleted;

    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->text = $datos['text'];
        $this->id_article = $datos['id_article'];
        $this->id_user = $datos['id_user'];
        $this->dateCom = $datos['date'];
        $this->deleted = $datos['deleted'];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getText()
    {
        return $this->text;
    }
    public function getIdArticle()
    {
        return $this->id_article;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function getDate()
    {
        return $this->dateCom;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setText($t)
    {
        $this->text = $t;
    }
    public function setDate($d)
    {
        $this->dateCom = $d;
    }
    public function setDeleted($d)
    {
        $this->deleted = $d;
    }
}
