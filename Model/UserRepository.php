<?php

use PSpell\Config;

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
        $bd->query($q);
    }
}
?>