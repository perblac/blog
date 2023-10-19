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
    require("Controller/".$_GET['c']."Controller.php");
    /*
    if ($_GET['c'] == "user") {
        require("Controller/userController.php");
    }
    if ($_GET['c'] == "article") {
        require("Controller/articleController.php");
    }
    if ($_GET['c'] == "comment") {
        require("Controller/commentController.php");
    }*/

}

// usar modelos

$articulos = ArticleRepository::getArticles();

// cargar vistas
include("View/mainView.phtml");
