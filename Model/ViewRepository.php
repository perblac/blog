<?php
/* -------------------------------------------------------------------------- */
/*                     métodos para imprimir en la página                     */
/* -------------------------------------------------------------------------- */
Class ViewRepository  {
    
    public static function getPagination($arrayGet, $numPage, $lastPage) {
        $s = '<a href="index.php?';
        foreach ($arrayGet as $key => $value) {
            $s .= $key . '=' . (($key == 'pagina') ? $numPage : $value . '&');
        }
        $s .= '">';
        if ($numPage == 1) $s .= 'primera';
        else if ($numPage == $lastPage) $s .= 'última';
        else $s .= $numPage;
        $s .= '</a>&nbsp;'; 
        return $s;
    }

    public static function getMenuPagination($arrayGet, $numArticulos) {
        $s = '(total resultados: ' . $numArticulos . ')<br>Página:&nbsp;';
        $paginas = ceil($numArticulos / 2);
        if ($arrayGet['pagina'] > 2) {
            $s .= ViewRepository::getPagination($arrayGet, 1, $paginas);
        }
        for ($i = ($arrayGet['pagina'] - 1); $i <= $arrayGet['pagina'] + 1; $i++) {
            if ($arrayGet['pagina'] != $i) {
                if ($i > 0 && $i < $paginas + 1) {
                    $s .= ViewRepository::getPagination($arrayGet, $i, $paginas);
                }
            } else {
                $s .= '<strong>' . $i . '</strong>';
            }
        }
        if ($arrayGet['pagina'] < $paginas - 1) {
            $s .= ViewRepository::getPagination($arrayGet, $paginas, $paginas);
        }
        return $s;
    }

    public static function printUserInfo() {
        $s = '<p> Usuario: ';
        $s .= $_SESSION['user']->getName();
        $s .= " - Rol: " . $_SESSION['user']->getRol() . "</p>";
        if ($_SESSION['user']->getRol() > 1) {
            $s .= "<a href='index.php?c=admin&panelDeControl=1'>Panel de Control</a><br>";
        }
        $s .= "<a href='index.php?logout=1&c=user'>logout</a><br>";
        return $s;
    }

    public static function printComents($idArticulo, $comments, $nivel = 0)
    {
        $s = '';
        foreach ($comments as $comentario) {
            $s .= '<tr><td>&nbsp;</td>';
            $s .= '<td style="font-size:.7em">En ' . $comentario->getDate() . '</td><td>'
                . str_repeat("&nbsp;|&nbsp;", $nivel) . ''
                . $comentario->getUser()->getName() . ' comentó:</td></tr>';
            $s .= '<tr><td>&nbsp;</td><td></td>';
            $s .= '<td colspan=3>'
                . str_repeat("&nbsp;|&nbsp;", $nivel) . ''
                . $comentario->getText() . '</td><td>'
                . (($_SESSION['user']->getRol() > 0) ? "<a href='index.php?c=comment&comentar=" . $idArticulo .
                    "&subC=" . $comentario->getId() .
                    "'>comentar</a>" : '') . '&nbsp;' . (($_SESSION['user']->getId() == $comentario->getIdUser()) ?
                    "<a href='index.php?c=comment&modificar=" . $comentario->getId() .
                    "'>M</a>&nbsp;<a href='index.php?c=comment&borrar=" . $comentario->getId() .
                    "'>X</a>" : '') . '</td>';
            $s .= '</tr>';
            $responses = $comentario->getResponses();
            if (!empty($responses)) {
                $s .= ViewRepository::printComents($idArticulo, $responses, $nivel + 1);
            }
        }
        return $s;
    }

    public static function printArticles($articulos) {
        $s = '';
        $s .= "<table><tr><th>Id</th><th>Título</th><th>Texto</th><th>Fecha</th><th>Autor</th><th></th></tr>";
        foreach ($articulos as $articulo) {
            $s .= '<tr><td>' . $articulo->getId() . '</td><td>'
                . $articulo->getTitle() . '</td><td style="font-size:1.2em;background-color:lightgray;">'
                . $articulo->getText() . '</td><td>'
                . $articulo->getDate() . '</td><td>'
                . $articulo->getAuthor()->getName() . "</td><td>"
                . (($_SESSION['user']->getRol() > 0) ? "<a href='index.php?c=user&comentar=" . $articulo->getId() . "&subC=0'>comentar</a>" : '') . "</td><tr>";
            foreach ($articulo->getComments() as $comment) {
                if ($comment->getIdComment() == 0) {
                    $s .= ViewRepository::printComents($articulo->getId(), [$comment]);
                }
            }
        }
        $s .= "</table>";
        return $s;
    }
}
