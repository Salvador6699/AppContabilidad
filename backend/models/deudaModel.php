<?php
require_once(__DIR__.'/../models/orm.php');
class DeudaModel extends Orm
{
    
    public function __construct(PDO $conexion)
    {
        parent::__construct ("idDeuda", "deuda",$conexion);
    }
    
}