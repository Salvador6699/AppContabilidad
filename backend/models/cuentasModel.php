<?php
require_once(__DIR__.'/../models/orm.php');
class CuentasModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct ("idCuenta","cuentas",$conexion);
    }
}