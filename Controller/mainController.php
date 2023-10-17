<?php

// cargar modelos
require_once("Model/ArticleClass.php");
require_once("Model/ArticleRepository.php");
require_once("Model/UserClass.php");
require_once("Model/UserRepository.php");
require_once("Model/CommentClass.php");
require_once("Model/CommentRepository.php");

session_start();

if (!empty($_GET['c'])) {
    if ($_GET['c'] == "user") {
        require("Controller/userController.php");
    }
    if ($_GET['c'] == "article") {
        require("Controller/articleController.php");
    }
    if ($_GET['c'] == "comment") {
        require("Controller/commentController.php");
    }
}


/*
if (isset($_GET['logout'])) {
    session_destroy();
    session_start();
}

if (!empty($_POST['login'])) {
    $_SESSION['user'] = UserRepository::checkLogin($_POST['user'], $_POST['password']);
    if ($_SESSION['user'] === null) echo '<script>alert("Usuario incorrecto");</script>';
}

if (isset($_GET['invitado'])) {
    $datos = [];
    $datos['id'] = 0;
    $datos['name'] = 'invitado';
    $datos['rol'] = 0;
    $_SESSION['user'] = new User($datos);
}

if (!empty($_POST['register'])) {
    if (UserRepository::checkUserExist($_POST['nombre'])) {
        echo '<script>alert("Nombre de usuario ya existe");</script>';
    } else UserRepository::registerUser($_POST['nombre'], $_POST['password']);
}

if (isset($_GET['borrar']) && $_SESSION['user']->getRol() > 0) {
    $comentario = CommentRepository::getCommentById($_GET['borrar']);
    if ($comentario->getIdUser() == $_SESSION['user']->getId()) {
        CommentRepository::deleteComment($comentario);
    }
}
*/

/*
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
    // CommentRepository::addComment($nuevoComentario);
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
*/

function linea($articulo, $comentario)
{
    echo '<tr><td> - </td><td>En ' . $comentario->getDate() . '</td><td>'
        . $comentario->getUser()->getName() . ' comentó:</td></tr>';
    echo '<tr><td> - </td><td></td><td colspan=3>' . $comentario->getText() . '</td><td>'
        . (($_SESSION['user']->getId() == $comentario->getIdUser()) ?
            "<a href='index.php?c=comment&modificar=" . $comentario->getId() .
            "'>modificar</a>&nbsp;<a href='index.php?c=comment&borrar=" . $comentario->getId() .
            "'>borrar</a>" : '') . ' ' . (($_SESSION['user']->getRol() > 0) ? "<a href='index.php?c=comment&comentar=" . $articulo->getId() .
            "&subC=" . $comentario->getId() .
            "'>comentar</a>" : '') . '</td></tr>';
}
// usar modelos

$articulos = ArticleRepository::getArticles();

// cargar vistas

include("View/mainView.phtml");
