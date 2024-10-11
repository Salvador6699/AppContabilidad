<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../services/conexion.php';

class DatabaseTest extends TestCase
{
    public function testConnection()
    {
        // Crear una instancia de la clase Database
        $db = new DatabaseConexion();
        
        // Obtener la conexión
        $conexion = $db->getConexion();

        // Asegurarse de que la conexión no sea null
        $this->assertNotNull($conexion, "La conexión no debe ser null");

        // Verificar si la consulta se ejecuta correctamente
        $stmt = $conexion->query("SELECT * FROM usuarios");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // CORRECCIÓN: Verifica si la consulta devolvió un resultado
        $this->assertNotFalse($result, "La consulta no devolvió resultados");
        
        // Asegúrate de que la clave 'id' (o cualquier otra clave que esperes) exista en el resultado
        $this->assertArrayHasKey('dniUsuario', $result, "La consulta no devolvió la clave 'id'");
    }
}


