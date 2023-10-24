<?php
Class ViewRepository  {
    
    public static function getPagination($arrayGet, $numPage, $lastPage) {
        $s = '<a href="index.php?';
        foreach ($arrayGet as $key => $value) {
            $s .= $key . '=' . (($key == 'pagina') ? $numPage : $value . '&');
        }
        $s .= '">';
        if ($numPage == 1) $s .= 'primero';
        else if ($numPage == $lastPage) $s .= 'ultimo';
        else $s .= $numPage;
        $s .= '</a>&nbsp;'; 
        return $s;
    }

    public static function getMenuPagination($arrayGet, $numArticulos) {
        $s = '(total resultados: ' . $numArticulos . ')<br>';
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
}

?>