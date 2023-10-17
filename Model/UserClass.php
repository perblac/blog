<?php
class User
{
    private $id, $nombre, $rol;

    public function __construct($datos)
    {
        $this->id = $datos['id'];
        $this->nombre = $datos['name'];
        $this->rol = $datos['rol'];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->nombre;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function setId($i)
    {
        $this->id = $i;
    }
    public function setName($n)
    {
        $this->nombre = $n;
    }
    public function setRol($r)
    {
        $this->rol = $r;
    }
}
