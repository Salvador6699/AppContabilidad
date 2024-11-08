<?php

require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/movimientoModel.php');

class MovimientosController extends ControllerViews
{
    private $movimientoModel;

    public function __construct(PDO $conexion)
    {
        $this->movimientoModel = new MovimientoModel($conexion);
    }

    public function getMovimientos()
    {
        $movimientos = $this->movimientoModel->getAll();
        $mapaColumnas = [
            "idMovimiento" => 'id',
            "importeMovimiento" => 'importe',
            "fechaMovimiento" => 'fecha',
            "comentarioMovimiento" => 'comentario',
            "tipoMovimiento_nomTipoMovimiento" => "tipo",
            "subcategorias_nomSubcategoria" => "subcategoria",
            "subcategorias_categorias_nomCategoria" => "categoria",
            "usuarios_dniUsuario" => "usuario",
            "cuentas_idCuenta" => "cuenta",
            "cuentas_usuarios_dniUsuario" => "usuario cuenta"
            // Añade más columnas si es necesario
        ];
        $movimientos = renombrarColumnas($movimientos, $mapaColumnas);
        $res=new Result();
        $res->message= count($movimientos) . ' registros de movimientos';
        $res->success=true;
        $res->result=$movimientos;
        createJsonFile($res, 'movimientos');
    }
}
