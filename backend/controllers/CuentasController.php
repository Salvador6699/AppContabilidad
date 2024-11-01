<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/cuentasModel.php');
class CuentasController extends ControllerViews
{
    private $cuentasModel;
    public function __construct(PDO $conexion)
    {
        $this->cuentasModel = new CuentasModel($conexion);
    }
    public function getCuentas()
    {
        $cuentas = $this->cuentasModel->getAll();
          // Mapeo de los nombres de las columnas que deseas cambiar
          $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
            // Añade más columnas si es necesario
        ];

        // Renombrar las columnas usando la función genérica
        $cuentasRenombradas = renombrarColumnas($cuentas, $mapaColumnas);
        $res = new Result();
        $res->success = true;
        $res->message = "Cuentas obtenidas correctamente";
        $res->result = $cuentasRenombradas;
        createJsonFile($res,'cuentas');
        
    }
    public function cuentasHome()
    {
        $this->render(['cuentas'],[],'plantilla');
    }
}
