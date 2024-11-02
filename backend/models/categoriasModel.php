<?php
require_once(__DIR__.'/../models/orm.php');
class CategoriasModel extends Orm
{
    
    public function __construct(PDO $conexion)
    {
        parent::__construct (["nomCategoria", "tipoCategoria"],"categorias",$conexion);
    }
    
}