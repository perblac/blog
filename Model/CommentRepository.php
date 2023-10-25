<?php

/* ------------------ métodos para trabajar con comentarios ----------------- */
class CommentRepository
{
    public static function getComments()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']) {
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function getCommentsWithDeleted()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            $comentarios[] = new Comment($datos);
        }
        return $comentarios;
    }

    public static function getCommentsFromArticle($idA)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id_article = '" . $idA . "'";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']) {
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function getCommentsFromArticleAndComments($idA, $idC)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id_article = '" . $idA . "' AND id_comment = '" . $idC . "'";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']) {
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function getCommentsFromUser($idU)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id_user = '" . $idU . "'";
        $result = $bd->query($q);
        $comentarios = [];
        while ($datos = $result->fetch_array()) {
            if (!$datos['deleted']) {
                $comentarios[] = new Comment($datos);
            }
        }
        return $comentarios;
    }

    public static function getCommentById($id)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM comments WHERE id = " . $id;
        $result = $bd->query($q);
        return new Comment($result->fetch_array());
    }

    public static function addComment($com)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO comments VALUES (NULL, '" . $com->getText() . "', " . $com->getIdArticle() . ", " . $com->getIdComment() . ", " . $com->getIdUser() . ",'" . $com->getDate() . "' ," . $com->getDeleted() . " )";
        $result = $bd->query($q);
    }

    public static function deleteComment($com)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE comments SET deleted = 1 WHERE id = " . $com->getId();
        $result = $bd->query($q);
    }

    public static function undeleteComment($com)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE comments SET deleted = 0 WHERE id = " . $com->getId();
        $result = $bd->query($q);
    }

    public static function modifyComment($com)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE comments SET text = '" . $com->getText() . "', date = '" . $com->getDate() . "' WHERE id = " . $com->getId();
        $result = $bd->query($q);
    }
}
