<?php
require_once(__DIR__.'/../models/orm.php');
class BalanceModel extends Orm
{
    
    public function __construct(PDO $conexion)
    {
        parent::__construct (["mesBalance", "anoBalance"],"balance",$conexion);
    }
    
}