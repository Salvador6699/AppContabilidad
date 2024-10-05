<?php
// backend/controllers/HomeController.php
require_once(__DIR__.'/../core/ControllerViews.php');
class HomeController extends ControllerViews {
    public function index() {
        $this->render(['home'],['cuenta'=>'LaCaixa','saldo'=>'255€'],'plantilla');
        
    }
    public function about() {
        echo "Esta es la página About <hr><a href='/'>home</a>";
    }
}
