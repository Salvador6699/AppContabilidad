<?php
class DatabaseConexion
{
    private $conexion;
    public function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        //PDO("nombre del servidor; nombre de la bbdd","usuario","contraseña")
        try {
            //intentamos la conexion en el servidor
            $this->conexion = new PDO("mysql:host=localhost;dbname=contahogar2", "mypruegasac0", "f20YOU1R");
        } catch (PDOException $e) {
            //intentamos la conexion en local
            $this->conexion = new PDO("mysql:host=localhost;dbname=contahogar2", "root","");
        }
        $this->conexion->exec("set names utf8");
    }
    public function getConexion()
    {
        return $this->conexion;
    }
    public function closeConexion()
    {
        $this->conexion = null;
    }
}
