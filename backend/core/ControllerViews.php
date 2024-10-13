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
}