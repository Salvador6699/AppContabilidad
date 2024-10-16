<?php
require_once(__DIR__ . '/../models/usuariosModel.php');
require_once(__DIR__ . '/../helper/common.php');
require_once(__DIR__ . '/../helper/renombrarColumnas.php');
class ControllerViews{

    protected function render($path=[], $parameters = [], $layout = '')
    {
        if (is_array($parameters)) {
            extract($parameters);
        }$elementos=count($path);
        ob_start();
        for ($i=0; $i <$elementos ; $i++) { 
            require_once(__DIR__ . '/../views/' . $path[$i] . '.view.php');
        }
        
        $content = ob_get_clean();
        require_once(__DIR__ . '/../views/layouts/' . $layout . '.layout.php');
    }
    protected function renderJson($data,$nombre)
    {
        header('Content-Type: application/json');
        $jsonData = json_encode($data);
        $file = __DIR__ . '/../cache/'.$nombre.'.json';
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
}