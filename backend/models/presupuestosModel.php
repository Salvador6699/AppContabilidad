<?php
require(__DIR__.'/../models/orm.php');
class PresupuestosModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct (["mesPresupuesto","anoPresupuesto"],"presupuestos",$conexion);
    }
}