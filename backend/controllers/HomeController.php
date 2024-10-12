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
    // Verifica si se proporcionó un valor de búsqueda
    $where = isset($_GET['filtro']) ? $_GET['filtro'] : null;
    $filter = isset($_GET['buscador']) ? $_GET['buscador'] : null;
    // Obtiene todos los usuarios o busca uno específico
    if ($where) {
        $usuarios = $this->usuariosModel->getByWhere($where,$filter); // Aquí asumo que getById puede recibir el id o nombre.
    } else {
        $usuarios = $this->usuariosModel->getAll(null, null, 'ASC');
    }

    // Mapeo de los nombres de las columnas que deseas cambiar
    $mapaColumnas = [
        'nomUsuario' => 'nombre',
        'emailUsuario' => 'email',
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
