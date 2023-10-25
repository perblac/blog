<?php
/* -------------------------------------------------------------------------- */
/*                         control sobre los artículos                        */
/* -------------------------------------------------------------------------- */

if (isset($_GET['nuevo']) && isset($_SESSION['user']) && $_SESSION['user']->getRol() > 1) {
    include("View/newArticleView.phtml");
    die;
}

if (isset($_POST['newArticle'])) {
    $datos['id'] = NULL;
    $datos['title'] = ($_POST['title']) ? $_POST['title'] : '<sin título>';
    $datos['text'] = $_POST['text'];
    $datos['date'] = (new DateTime())->format('Y-m-d H:i:s');
    $datos['id_user'] = $_POST['idUser'];
    $articulo = new Article($datos);
    ArticleRepository::addArticle($articulo);
}

if (isset($_GET['query'])) {
    $opcion = isset($_GET['ordenAlfa']) * 2 + isset($_GET['ordenFecha']);
    $articulos = ArticleRepository::searchArticles($_GET['query'], $opcion, $_GET['sortOrder'], $_GET['pagina']);
    $numArticulos = ArticleRepository::numSearchArticles($_GET['query']);
    include("View/mainView.phtml");
    die;
}
