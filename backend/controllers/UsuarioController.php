<?php
// backend/controllers/HomeController.php
require_once(__DIR__ . '/../core/ControllerViews.php');


class UsuarioController extends ControllerViews
{
    private $usuariosModel;

    public function __construct(PDO $conexion)
    {
        $this->usuariosModel = new UsuariosModel($conexion);
    }

    public function usuariosHome() {
    $this->render(['listar'],[],'plantilla');
    }
    public function buscarUsuario() {
     // Verifica si se proporcionó un valor de búsqueda
        $where = isset($_GET['filtro']) ? $_GET['filtro'] : null;
        $filter = isset($_GET['buscador']) ? $_GET['buscador'] : null;
        $usuarios=$this->usuariosModel->getByWhere($where,$filter);
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
    public function listar()
    {
       
        // Obtiene todos los usuarios o busca uno específico
        
            $usuarios = $this->usuariosModel->getAll(null, null, 'ASC');
        

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

        $jsonData = json_encode($res);
        $file = __DIR__ . '/../cache/usuarios.json';
        $fp = fopen($file, 'w');

        if ($fp) {
            // Escribir los datos JSON en el archivo
            fwrite($fp, $jsonData);
            // Cerrar el archivo
            fclose($fp);
            echo "El archivo JSON se creó correctamente.";
        } else {
            echo "Error al crear el archivo JSON.";
        }
        
    }

    public function about()
    {

        echo "Esta es la página About <hr><a href='/'>home</a>";
    }
}
