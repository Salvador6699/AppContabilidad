<?php


require_once(__DIR__ . '/../helper/common.php');
require_once(__DIR__ . '/../helper/funcionesController.php');
class ControllerViews{

    protected function render($path=[], $parameters = [], $layout = '')
    {
        if (is_array($parameters)) {
            extract($parameters);
        }$elementos=count($path);
        ob_start();
        for ($i=0; $i <$elementos ; $i++) { 
            if (file_exists(__DIR__ . '/../views/' . $path[$i] . '.view.html')) {
                require_once(__DIR__ . '/../views/' . $path[$i] . '.view.html');
            } else if (file_exists(__DIR__ . '/../views/' . $path[$i] . '.view.php')) {
                require_once(__DIR__ . '/../views/' . $path[$i] . '.view.php');
            } else {
                require_once(__DIR__ . '/../views/vista.404.view.html');
            }
            
        }
        
        $content = ob_get_clean();
        require_once(__DIR__ . '/../views/layouts/' . $layout . '.layout.php');
    }
}