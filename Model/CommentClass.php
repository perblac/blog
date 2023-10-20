<?php

class Comment{
    private $id, $text, $id_article, $id_comment, $id_user, $dateCom, $deleted, $user, $responses;

    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->text = $datos['text'];
        $this->id_article = $datos['id_article'];
        $this->id_comment = $datos['id_comment'];
        $this->id_user = $datos['id_user'];
        $this->dateCom = $datos['date'];
        $this->deleted = $datos['deleted'];
        $this->user = UserRepository::getUserById($this->id_user);
        $this->responses = CommentRepository::getCommentsFromArticleAndComments($this->id_article,$this->id);
    }

    // getters
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
    public function getIdComment()
    {
        return $this->id_comment;
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
    public function getUser()
    {
        return $this->user;
    }
    public function getResponses()
    {
        return $this->responses;
    }

    // setters
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

    // metodo para crear comentario en la BBDD
    public function save() {
        $bd=Conectar::conexion();
        $q = "INSERT INTO comments VALUES (NULL, '".$this->getText()."', ".$this->getIdArticle().", ".$this->getIdComment().", ".$this->getIdUser().",'".$this->getDate()."' ,".$this->getDeleted()." )";
        $result = $bd->query($q);
    }
}
