<?php
/* -------------------------------------------------------------------------- */
/*                         control sobre los artículos                        */
/* -------------------------------------------------------------------------- */
if (isset($_GET['nuevo'])) {
    include("View/newArticleView.phtml");
}

if (isset($_POST['newArticle'])) {
    $datos['id'] = NULL;
    $datos['title'] =($_POST['title'])?$_POST['title']:'<sin título>';
    $datos['text'] = $_POST['text'];
    $datos['date'] = (new DateTime())->format('Y-m-d H:i:s');
    $datos['id_user'] = $_POST['idUser'];
    $articulo = new Article($datos);
    ArticleRepository::addArticle($articulo);
}
?>