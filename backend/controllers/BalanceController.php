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
        $mapaColumnas = [
            'mesBalance'=>'mes',
            'anoBalance'=>'ano',
            'importeBalance'=>'importe',
            'categorias_nomCategoria'=>'categoria'
        ];

        // Renombrar las columnas usando la función genérica
        $balance = renombrarColumnas($balance, $mapaColumnas);
        $res = new Result();
        $res->message= count($balance) . ' registros de balances';
        $res->success = true;
        $res->result = $balance;
        createJsonFile($res, 'balance');
    }
}
