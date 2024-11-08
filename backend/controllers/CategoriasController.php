<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
require_once(__DIR__ . '/../models/categoriasModel.php');
require_once(__DIR__.'/../models/subcategoriasModel.php');
class CategoriasController extends ControllerViews
{
    private $categoriasModel;
    private $subcategoriasModel;
    public function __construct(PDO $conexion)
    {
        $this->categoriasModel = new CategoriasModel($conexion);
        $this->subcategoriasModel=new SubcategoriasModel($conexion);
    }
    public function getCategorias()
    {
        $categorias = $this->categoriasModel->getAll();
        $subcategorias = $this->subcategoriasModel->getAll();
        
        // Mapeo de los nombres de las columnas que deseas cambiar
        $columnasCategorias= [
            'nomCategoria' => 'nombre',
            'tipoCategoria' => 'tipo'
        ];
        $columnasSubcategorias=[
          'nomSubcategoria'=>'subcategoria',
          'categorias_nomCategoria'=>'categoria'
        ];
        
        // Renombrar las columnas usando la función genérica
        $categorias = renombrarColumnas($categorias, $columnasCategorias);
        $subcategorias=renombrarColumnas($subcategorias,$columnasSubcategorias);
        
        // Agrupar subcategorías por categoría
        $subcategoriasAgrupadas = [];
        foreach ($subcategorias as $subcategoria) {
            $subcategoriasAgrupadas[$subcategoria['categoria']][] = $subcategoria; 
        }

        // Añadir subcategorías a cada categoría
        foreach ($categorias as &$categoria) {
            $categoria['subcategorias'] = $subcategoriasAgrupadas[$categoria['nombre']] ?? []; // Asumiendo que 'id' es la clave de la categoría
        }

        $res = new Result();
        $res->message = count($categorias) . ' registros de categorias';
        $res->success = true;
        $res->result = $categorias;
        createJsonFile($res, 'categorias');
        header('Location: /'); exit(); // Asegúrate de usar exit() para detener la ejecución del script
    }
    
}