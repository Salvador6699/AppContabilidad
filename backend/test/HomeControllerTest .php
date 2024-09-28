<?php
// backend/tests/HomeControllerTest.php
use PHPUnit\Framework\TestCase;

class HomeControllerTest  extends TestCase {
    public function testIndexReturnsWelcomeMessage() {
        $controller = new HomeController();
        $response = $controller->index();

        $this->assertEquals("Bienvenido a la página de inicio", $response);
    }
}
