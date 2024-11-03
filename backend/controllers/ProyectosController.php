<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/proyectosModel.php');
class ProyectosController extends ControllerViews
{
    private $proyectosModel;
    public function __construct(PDO $conexion)
    {
        $this->proyectosModel = new ProyectosModel($conexion);
    }
    public function getProyectos()
    {
        $proyectos = $this->proyectosModel->getAll();
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
        $res->result=$proyectos;
        createJsonFile($res,'proyectos');
        
    }
    
}