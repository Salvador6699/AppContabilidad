<?php
require_once(__DIR__ . '/../core/ControllerViews.php');
class ErrorController extends ControllerViews
{

    public function home()
    {
        $this->render(['404'], [], 'plantilla');
        
    }
}