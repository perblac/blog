<?php

// métodos para trabajar con los artículos
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

}

?>