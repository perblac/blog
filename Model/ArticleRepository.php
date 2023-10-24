<?php

/* ----------------- métodos para trabajar con los artículos ---------------- */
class ArticleRepository{

    public static function getArticles(){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM articles";
        $result = $bd->query($q);
        $articulos = [];
        while ($datos = $result->fetch_assoc()) {
            $articulos[] = new Article($datos);
        }
        return $articulos;
    }

    public static function addArticle($art){
        $bd=Conectar::conexion();
        $q = "INSERT INTO articles VALUES (NULL, '".$art->getTitle()."', '".$art->getText()."', '".$art->getDate()."', ".$art->getAuthor()->getId().")";
        $result=$bd->query($q);
    }

    public static function searchArticles($query, $order){
        $bd=Conectar::conexion();
        $q = "SELECT * FROM articles WHERE text LIKE '%".$query."%' OR title LIKE '%".$query."%' ";
        $q .= ($order == 3)?' ORDER BY title, date ':(($order == 2)?' ORDER BY title ':(($order == 1)?' ORDER BY date ':''));
        $articulos = [];
        $result = $bd->query($q);
        while($datos=$result->fetch_assoc()) {
            $articulos[] = new Article($datos);
        }
        return $articulos;
    }
}
