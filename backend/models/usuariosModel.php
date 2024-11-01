<?php
require(__DIR__.'/../models/orm.php');
class UsuariosModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct ("dniUsuario","usuarios",$conexion);
    }
}