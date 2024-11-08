<?php
// backend/controllers/HomeController.php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/usuariosModel.php');

class UsuarioController extends ControllerViews
{
    private $usuariosModel;

    public function __construct(PDO $conexion)
    {
        $this->usuariosModel = new UsuariosModel($conexion);
    }

    public function usuariosHome() {
    $this->render(['usuarios'],[],'plantilla');
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
            'dniUsuario' => 'dni',
            'passwordUsuario' => 'password',
            // Añade más columnas si es necesario
        ];

        // Renombrar las columnas usando la función genérica
        $usuariosRenombrados = renombrarColumnas($usuarios, $mapaColumnas);
        echo json_encode($usuariosRenombrados);
    }
    public function getUsuarios()
    {
       
        // Obtiene todos los usuarios o busca uno específico
        
            $usuarios = $this->usuariosModel->getAll();
        

        // Mapeo de los nombres de las columnas que deseas cambiar
        $mapaColumnas = [
            'nomUsuario' => 'nombre',
            'emailUsuario' => 'email',
            'dniUsuario' => 'dni',
            'passwordUsuario' => 'password',
        ];

        // Renombrar las columnas usando la función genérica
        $usuariosRenombrados = renombrarColumnas($usuarios, $mapaColumnas);
        $res=new Result();
        $res->message=count($usuarios).' registros de usuario';
        $res->success=true;
        $res->result=$usuariosRenombrados;
        createJsonFile($res,'usuarios');
        $this->render(['usuarios'],[],'plantilla');
        
    }

}
