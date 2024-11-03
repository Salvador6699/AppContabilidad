<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/subcategoriasModel.php');
class SubcategoriasController extends ControllerViews
{
    private $subcategoriasModel;
    public function __construct(PDO $conexion)
    {
        $this->subcategoriasModel = new SubcategoriasModel($conexion);
    }
    public function getSubcategorias()
    {
        $subcategorias = $this->subcategoriasModel->getAll();
          // Mapeo de los nombres de las columnas que deseas cambiar
         /* $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
        ];

        // Renombrar las columnas usando la función genérica
        $cuentas = renombrarColumnas($cuentas, $mapaColumnas);*/
        $res=new Result();
        $res->message='mensaje';
        $res->success=true;
        $res->result=$subcategorias;
        createJsonFile($res,'subcategorias');
        
    }
    
}