<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/presupuestosModel.php');
class PresupuestosController extends ControllerViews
{
    private $presupuestosModel;
    public function __construct(PDO $conexion)
    {
        $this->presupuestosModel = new PresupuestosModel($conexion);
    }
    public function getPresupuestos()
    {
        $presupuestos = $this->presupuestosModel->getAll();
          // Mapeo de los nombres de las columnas que deseas cambiar
         $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
        ];

        // Renombrar las columnas usando la función genérica
        $presupuestos = renombrarColumnas($presupuestos, $mapaColumnas);
        $res=new Result();
        $res->message=count($presupuestos).' registros de presupuestos';
        $res->success=true;
        $res->result=$presupuestos;
        createJsonFile($res,'presupuestos');
        
    }
    
}