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

if (!empty($_POST['register'])) {
    if (UserRepository::checkUserExist($_POST['nombre'])) {
        echo '<script>alert("Nombre de usuario ya existe");</script>';
    } else {
        UserRepository::registerUser($_POST['nombre'], $_POST['password']);
    }
}
