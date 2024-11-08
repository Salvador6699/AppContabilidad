<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/categoriasModel.php');
class CategoriasController extends ControllerViews
{
    private $categoriasModel;
    public function __construct(PDO $conexion)
    {
        $this->categoriasModel = new CategoriasModel($conexion);
    }
    public function getCategorias()
    {
        $categorias = $this->categoriasModel->getAll();
          // Mapeo de los nombres de las columnas que deseas cambiar
          $mapaColumnas = [
            'nomCategoria'=>'nombre',
            'tipoCategoria'=>'tipo'
          ];
        // Renombrar las columnas usando la función genérica
        $categorias = renombrarColumnas($categorias, $mapaColumnas);
        $res=new Result();
        $res->message= count($categorias) . ' registros de categorias';
        $res->success=true;
        $res->result=$categorias;
        createJsonFile($res,'categorias');
        
    }
    
}