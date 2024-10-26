<?php
// backend/controllers/HomeController.php
require_once(__DIR__ . '/../core/ControllerViews.php');


class HomeController extends ControllerViews
{


    public function __construct(PDO $conexion)
    {
        
    }

    public function index()
    {
        $this->render(['home'], [], 'plantilla');
    }
}