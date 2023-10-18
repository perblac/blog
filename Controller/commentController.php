<?php
/* -------------------------------------------------------------------------- */
/*                        control sobre los comentarios                       */
/* -------------------------------------------------------------------------- */

if (isset($_POST['comment'])) {
    $com = [];
    $com['id'] = null;
    $com['text'] = $_POST['text'];
    $com['id_article'] = $_POST['idArticle'];
    $com['id_comment'] = $_POST['subcomentario'];
    $com['id_user'] = $_SESSION['user']->getId();
    $com['date'] = (new DateTime())->format('Y-m-d H:i:s');
    $com['deleted'] = 0;
    $nuevoComentario = new Comment($com);
    $nuevoComentario->save();
}

if (isset($_POST['modify'])) {
    $com = CommentRepository::getCommentById($_POST['idComment']);
    $com->setText($_POST['text']);
    $com->setDate((new DateTime())->format('Y-m-d H:i:s'));
    if ($com->getIdUser() == $_SESSION['user']->getId()) {
        CommentRepository::modifyComment($com);
    }
}

if (isset($_GET['borrar']) && $_SESSION['user']->getRol() > 0) {
    $comentario = CommentRepository::getCommentById($_GET['borrar']);
    if ($comentario->getIdUser() == $_SESSION['user']->getId()) {
        CommentRepository::deleteComment($comentario);
    }
}

?>