<?php
/* -------------------------------------------------------------------------- */
/*                              control principal                             */
/* -------------------------------------------------------------------------- */

// cargar modelos
require_once("Model/ArticleClass.php");
require_once("Model/ArticleRepository.php");
require_once("Model/UserClass.php");
require_once("Model/UserRepository.php");
require_once("Model/CommentClass.php");
require_once("Model/CommentRepository.php");
require_once("Model/ViewRepository.php");

session_start();

if (!empty($_GET['c'])) {
    //TODO: controlar que 'c' es válido
    require("Controller/".$_GET['c']."Controller.php");
} else {
    require("Controller/userController.php");
}

// usar modelos
$articulos = ArticleRepository::getArticles();

// cargar vistas
include("View/mainView.phtml");
