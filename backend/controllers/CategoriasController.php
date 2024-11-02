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
         /* $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
        ];

        // Renombrar las columnas usando la función genérica
        $cuentas = renombrarColumnas($cuentas, $mapaColumnas);*/
        createJsonFile($categorias,'categorias');
        
    }
    
}