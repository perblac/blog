<?php
/* -------------------------------------------------------------------------- */
/*                         control sobre los usuarios                         */
/* -------------------------------------------------------------------------- */

if (isset($_GET['logout'])) {
    session_destroy();
    session_start();
}

if (!empty($_POST['login'])) {
    $_SESSION['user'] = UserRepository::checkLogin($_POST['user'], $_POST['password']);
    if ($_SESSION['user'] === null) {
        echo '<script>alert("Usuario incorrecto");</script>';
        unset($_SESSION['user']);
    };
}

if (isset($_GET['invitado'])) {
    $datos = [];
    $datos['id'] = 0;
    $datos['name'] = 'invitado';
    $datos['rol'] = 0;
    $_SESSION['user'] = new User($datos);
}

if (isset($_POST['register'])) {
    if (UserRepository::checkUserExist($_POST['nombre'])) {
        echo '<script>alert("El nombre de usuario \"'.$_POST['nombre'].'\"  ya existe");</script>';
    } else {
        UserRepository::registerUser($_POST['nombre'], $_POST['password']);
        $_SESSION['user'] = UserRepository::checkLogin($_POST['nombre'], $_POST['password']);
        unset($_GET['registroFrm']);
        header('location: index.php');
    }
}

if (!isset($_SESSION['user']) && !isset($_GET['registroFrm'])) {
    include('View/loginView.phtml');
    die;
}

if (isset($_GET['registroFrm'])) {
    include('View/registerView.phtml');
    die;
}
