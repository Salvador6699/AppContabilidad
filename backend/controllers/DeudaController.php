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
         /* $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
        ];

        // Renombrar las columnas usando la función genérica
        $cuentas = renombrarColumnas($cuentas, $mapaColumnas);*/
        createJsonFile($deudas,'deudas');
        
    }
    
}