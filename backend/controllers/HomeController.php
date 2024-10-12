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
        $this->render(['listar'], [], 'plantilla');
    }
    public function listar()
    {
        // Obtiene todos los usuarios
        $usuarios = $this->usuariosModel->getAll(null, null, 'ASC');
        // Mapeo de los nombres de las columnas que deseas cambiar
        $mapaColumnas = [
            'nomUsuario' => 'nombre',
            'emailUsuario' => 'email', // Ejemplo de otra columna
            // Añade más columnas si es necesario
        ];

        // Renombrar las columnas usando la función genérica
        $usuariosRenombrados = renombrarColumnas($usuarios, $mapaColumnas);
        $res = new Result();
        $res->success = true;
        $res->result = $usuariosRenombrados;
        echo json_encode($res);
    }
    public function about()
    {

        echo "Esta es la página About <hr><a href='/'>home</a>";
    }
}
