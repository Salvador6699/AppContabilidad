<?php
require(__DIR__.'/../models/orm.php');
class ProyectosModel extends Orm
{
    public function __construct(PDO $conexion)
    {
        parent::__construct ("idProyecto","proyectos",$conexion);
    }
}