<?php

class CommentRepository {

    public static function getComments(){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM comments";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']){
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }
    public static function getCommentsWithDeleted(){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM comments";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            $comentarios[] = new Comment($datos);
        }
        return $comentarios;
    }

    public static function getCommentsFromcomicle($idA){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id_comicle = '".$idA."'";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']){
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function getCommentsFromUser($idU){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id_user = '".$idU."'";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']){
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function addComment($com) {
        $bd=Conectar::conexion();
        $q = "INSERT INTO comments VALUES (NULL, '".$com->getText()."', ".$com->getIdArticle().", ".$com->getIdUser().",'".$com->getDate()."' ,".$com->getDeleted()." )";
        $result = $bd->query($q);
    }
}

?>
