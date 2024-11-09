<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/cuentasModel.php');
require_once __DIR__ . '/../helper/formato.datos.php';
class CuentasController extends ControllerViews
{
    private $cuentasModel;
    public function __construct(PDO $conexion)
    {
        $this->cuentasModel = new CuentasModel($conexion);
    }
    public function getCuentas()
    {
        $cuentas = $this->cuentasModel->ultimoMovimiento();
        // Formatear los datos antes de incluirlos en el JSON
        foreach ($cuentas as &$cuenta) {
            $cuenta['fechaMovimiento'] = fecha($cuenta['fechaMovimiento'], 'dia_mes');
        }
        // Mapeo de los nombres de las columnas que deseas cambiar
        $mapaColumnas = [
            'idCuenta' => 'id',
            'nomCuenta' => 'cuenta',
            'saldoCuenta' => 'saldo',
            'usuarios_dniUsuario' => 'dni',
            'fechaMovimiento' => 'fecha',
            'importeMovimiento' => 'importe',
            'subcategorias_nomSubcategoria' => 'concepto',
            'subcategorias_categorias_nomCategoria'=>'categoria',
        ];

        // Renombrar las columnas usando la función genérica
        $cuentas = renombrarColumnas($cuentas, $mapaColumnas);
        $res = new Result();
        $res->message = count($cuentas) . ' registros de cuentas';
        $res->success = true;
        $res->result = $cuentas;
        createJsonFile($res, 'cuentas');
    }
    public function cuentasHome()
    {
        $this->render(['cuentas'], [], 'plantilla');
    }
}
