<?php

/* ----------------- métodos para trabajar con los artículos ---------------- */
class ArticleRepository
{

    public static function getArticles()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM articles";
        $result = $bd->query($q);
        $articulos = [];
        while ($datos = $result->fetch_assoc()) {
            $articulos[] = new Article($datos);
        }
        return $articulos;
    }

    public static function addArticle($art)
    {
        $bd = Conectar::conexion();
        $q = "INSERT INTO articles VALUES (NULL, '" . $art->getTitle() . "', '" . $art->getText() . "', '" . $art->getDate() . "', " . $art->getAuthor()->getId() . ")";
        $result = $bd->query($q);
    }

    public static function searchArticles($query, $order, $sortOrder, $pagina)
    {
        $bd = Conectar::conexion();
        $articulos = [];
        if (!empty($query)) {
            $q = "SELECT * FROM articles WHERE text LIKE '%" . $query . "%' OR title LIKE '%" . $query . "%' ";
            $q .= ($order == 3) ? ' ORDER BY title, date '.$sortOrder : (($order == 2) ? ' ORDER BY title '.$sortOrder : (($order == 1) ? ' ORDER BY date '.$sortOrder : ''));
        } else {
            $q = "SELECT * FROM articles";
        }
        if ($pagina > 0) {
            $offset = -2 + 2 * $pagina;
            $q .= ' LIMIT 2 OFFSET '.$offset;
        }

        $result = $bd->query($q);
        while ($datos = $result->fetch_assoc()) {
            $articulos[] = new Article($datos);
        }
        return $articulos;
    }

    public static function numSearchArticles($query)
    {
        $bd = Conectar::conexion();
        $numArticulos = 0;
        if (!empty($query)) {
            $q = "SELECT COUNT(*) FROM articles WHERE text LIKE '%" . $query . "%' OR title LIKE '%" . $query . "%' ";
        } else {
            $q = "SELECT COUNT(*) FROM articles";
        }
        $result = $bd->query($q);
        $datos = $result->fetch_array();
        $numArticulos = $datos[0];
        
        return $numArticulos;
    }
}
