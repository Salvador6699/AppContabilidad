<?php
// backend/controllers/HomeController.php
require_once(__DIR__ . '/../core/ControllerViews.php');


class HomeController extends ControllerViews
{
    private $usuariosModel;

    public function __construct(PDO $conexion)
    {
        $this->usuariosModel = new UsuariosModel($conexion);
    }

    public function index()
    {
        $this->render(['home'], [], 'plantilla');
    }
}