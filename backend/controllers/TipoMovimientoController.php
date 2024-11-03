<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/tipoMovimientoModel.php');
class TipoMovimientoController extends ControllerViews
{
    private $tipoMovimientoModel;
    public function __construct(PDO $conexion)
    {
        $this->tipoMovimientoModel = new TipoMovimientoModel($conexion);
    }
    public function getTipoMovimiento()
    {
        $tipoMovimiento = $this->tipoMovimientoModel->getAll();
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
        $res->result=$tipoMovimiento;
        createJsonFile($res,'tipoMovimiento');
        
    }
    
}