<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/balanceModel.php');
class BalanceController extends ControllerViews
{
    private $balanceModel;
    public function __construct(PDO $conexion)
    {
        $this->balanceModel = new BalanceModel($conexion);
    }
    public function getBalance()
    {
        $balance = $this->balanceModel->getAll();
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
        $res->result=$balance;
        createJsonFile($res, 'balance');
    }
}
