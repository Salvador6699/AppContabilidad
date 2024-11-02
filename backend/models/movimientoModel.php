<?php
require(__DIR__.'/../models/orm.php');
class MovimientoModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct ("idMovimiento","movimientos",$conexion);
    }
}