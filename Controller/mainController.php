<?php

// cargar modelos
require_once("Model/ArticleClass.php");
require_once("Model/ArticleRepository.php");
require_once("Model/UserClass.php");
require_once("Model/UserRepository.php");
require_once("Model/CommentClass.php");
require_once("Model/CommentRepository.php");

session_start();

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

if (isset($_GET['comentar']) && $_SESSION['user']->getRol() > 0) {
?>
    <form action="index.php" method="POST">
        <div>
            <fieldset style="display: inline-block;">
                <textarea name="text" cols="40" rows="5" placeholder="Su comentario"></textarea><br>
                <input type="hidden" id="idUser" name="idUser" value="<?php echo $_SESSION['user']->getId(); ?>">
                <input type="hidden" id="idArticle" name="idArticle" value="<?php echo $_GET['comentar']; ?>">
                <input type="submit" name="comment" value="Comentar" /><br>
            </fieldset>
        </div>
    </form>
<?php
}

if (isset($_POST['comment'])) {
    $com = [];
    $com['id'] = null;
    $com['text'] = $_POST['text'];
    $com['id_article'] = $_POST['idArticle'];
    $com['id_user'] = $_POST['idUser'];
    $com['date'] = (new DateTime())->format('Y-m-d H:i:s');
    $com['deleted'] = 0;
    $nuevoComentario = new Comment($com);
    CommentRepository::addComment($nuevoComentario);
}

if (isset($_GET['borrar']) && $_SESSION['user']->getRol() > 0) {
    $comentario = CommentRepository::getCommentById($_GET['borrar']);
    if ($comentario->getIdUser() == $_SESSION['user']->getId()) {
        CommentRepository::deleteComment($comentario);
    }
}

if (isset($_GET['modificar']) && $_SESSION['user']->getRol() > 0) {
    $com = CommentRepository::getCommentById($_GET['modificar']);
    $text = $com->getText();
    var_dump($text);
?>
    <form action="index.php" method="POST">
        <div>
            <fieldset style="display: inline-block;">
                <textarea name="text" cols="40" rows="5"><?php echo $text; ?></textarea><br>
                <input type="hidden" id="idComment" name="idComment" value="<?php echo $com->getId(); ?>">
                <input type="submit" name="modify" value="Actualizar" /><br>
            </fieldset>
        </div>
    </form>
<?php
}

if (isset($_POST['modify'])) {
    $com = CommentRepository::getCommentById($_POST['idComment']);
    $com->setText($_POST['text']);
    $com->setDate((new DateTime())->format('Y-m-d H:i:s'));
    if ($com->getIdUser() == $_SESSION['user']->getId()) {
        CommentRepository::modifyComment($com);
    }
}
// usar modelos


// cargar vistas
if (isset($_SESSION['user'])) {
    $articulos = ArticleRepository::getArticles();
    $comentarios = CommentRepository::getComments();
    include("View/mainView.phtml");
} else if (isset($_GET['registro']))
    include("View/registerView.phtml");
else
    include("View/loginView.phtml");
