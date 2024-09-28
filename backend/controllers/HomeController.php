<?php
// backend/controllers/HomeController.php

class HomeController {
    public function index() {
        echo "Bienvenido a la página de inicio <hr> <a href='prueba'>about</a>";
        return "Bienvenido a la página de inicio";
    }
    public function about() {
        echo "Esta es la página About <hr><a href='/'>home</a>";
    }
}
