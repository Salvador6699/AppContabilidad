<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/deudaModel.php');
class DeudaController extends ControllerViews
{
    private $deudasModel;
    public function __construct(PDO $conexion)
    {
        $this->deudasModel = new DeudaModel($conexion);
    }
    public function getDeuda()
    {
        $deudas = $this->deudasModel->getAll();
          // Mapeo de los nombres de las columnas que deseas cambiar
          $mapaColumnas = [
            'idDeuda'=>'id',
            'nomDeuda'=>'nombre',
            'totalDeuda'=>'deuda total',
            'restoDeuda'=>'pendiente',
        ];

        // Renombrar las columnas usando la función genérica
        $deudas = renombrarColumnas($deudas, $mapaColumnas);
        $res=new Result();
        $res->message= count($deudas) . ' registros de deudas';
        $res->success=true;
        $res->result=$deudas;
        createJsonFile($res,'deudas');
        
    }
    
}