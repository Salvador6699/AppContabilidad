<?php
require(__DIR__.'/../models/orm.php');
class TipoMovimientoModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct ("nomTipoMovimiento","tipoMovimiento",$conexion);
    }
}