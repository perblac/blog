<?php

/* ------------------- métodos para trabajar con usuarios ------------------- */
class UserRepository{
    public static function checkLogin($n,$pass) {
        
        $bd=Conectar::conexion();

        $q = "SELECT * FROM users WHERE name='" . $n . "' AND password='".md5($pass)."';";
        $result = $bd->query($q);
        if ($datos = $result->fetch_assoc()){
            return new User($datos);            
        }        
        return null;
    }

    public static function getUserById($id){
        $bd=Conectar::conexion();
        $q="SELECT * FROM users WHERE id = ".$id;
        $result=$bd->query($q);
        if($datos=$result->fetch_assoc()){
            return new User($datos);
        }
        return null;
    }

    public static function checkUserExist($n) {
        $bd=Conectar::conexion();
        $q="SELECT name FROM users WHERE name = '".$n."'";
        $result=$bd->query($q);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public static function registerUser($n,$p) {
        $bd=Conectar::conexion();
        $q="INSERT INTO users VALUES (NULL, '".$n."', '".md5($p)."', 1, 0)";
        $result=$bd->query($q);
    }

    public static function getUsers() {
        $bd=Conectar::conexion();
        $q="SELECT * FROM users";
        $result=$bd->query($q);
        $users = [];
        while($datos=$result->fetch_assoc()) {
            $users[] = new User($datos);
        }
        return $users;
    }
    
    public static function getUsersExceptMe() {
        $bd=Conectar::conexion();
        $q="SELECT * FROM users WHERE id <> ".$_SESSION['user']->getId();
        $result=$bd->query($q);
        $users = [];
        while($datos=$result->fetch_assoc()) {
            $users[] = new User($datos);
        }
        return $users;
    }

    public static function setUserRol($id,$rol) {
        $bd=Conectar::conexion();
        $q="UPDATE users SET rol = ".$rol." WHERE id = ".$id;
        $result=$bd->query($q);
    }
}
?>