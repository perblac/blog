<?php
if (isset($_GET['panelDeControl']) && $_SESSION['user']->getRol() > 1) {
    include("View/adminView.phtml");
    die;
}

if (isset($_GET['cambiarRoles']) && $_SESSION['user']->getRol() > 1) {
    $users = UserRepository::getUsersExceptMe();
    include("View/roleChangeView.phtml");
    die;
}

if (isset($_POST['newRol'])) {
    UserRepository::setUserRol($_POST['idUser'], $_POST['newRol']);
    header('location: index.php?c=admin&cambiarRoles=1');
}

?>