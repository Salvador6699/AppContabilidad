<?php
require_once(__DIR__.'/../models/orm.php');
class SubcategoriasModel extends Orm
{
    
    public function __construct(PDO $conexion)
    {
        parent::__construct ("nomSubcategoria","subcategorias",$conexion);
    }
    
}