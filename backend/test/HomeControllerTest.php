<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../core/ControllerViews.php';
require_once __DIR__ . '/../controllers/HomeController.php';

class HomeControllerTest extends TestCase
{
    public function testIndexRendersCorrectView()
    {
        // Simula el controlador
        $controller = new HomeController();

        // Captura la salida
        ob_start();
        $controller->index();
        $output = ob_get_clean();

        // Comprueba que se renderiza correctamente el contenido de la vista
        $this->assertStringContainsString('LaCaixa', $output);
        $this->assertStringContainsString('255€', $output);
    }

    public function testAboutPage()
    {
        $controller = new HomeController();

        // Captura la salida
        ob_start();
        $controller->about();
        $output = ob_get_clean();

        // Comprueba que la salida sea correcta
        $this->assertStringContainsString('Esta es la página About', $output);
        $this->assertStringContainsString('<a href=\'/\'>home</a>', $output);
    }
}
