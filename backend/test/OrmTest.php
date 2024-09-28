<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/orm.php';

class OrmTest extends TestCase
{
    protected $pdo;
    protected $pdoStatement;
    protected $orm;

    protected function setUp(): void
    {
        // Mock del objeto PDO
        $this->pdo = $this->createMock(PDO::class);
        
        // Mock del objeto PDOStatement
        $this->pdoStatement = $this->createMock(PDOStatement::class);

        // Crear una instancia de la clase Orm con mocks
        $this->orm = new Orm('id', 'test_table', $this->pdo);
    }

    public function testGetAll()
    {
        // Definir lo que debe devolver el método fetchAll
        $expectedResult = [['id' => 1, 'name' => 'Test']];
        $this->pdoStatement->method('fetchAll')->willReturn($expectedResult);
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método getAll y comprobar que el resultado es el esperado
        $result = $this->orm->getAll(10, 'id', 'ASC');
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetById()
    {
        // Definir lo que debe devolver el método fetch
        $expectedResult = ['id' => 1, 'name' => 'Test'];
        $this->pdoStatement->method('fetch')->willReturn($expectedResult);
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método getById y comprobar que el resultado es el esperado
        $result = $this->orm->getById(1);
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetByWhere()
    {
        // Definir lo que debe devolver el método fetchAll
        $expectedResult = [['id' => 1, 'name' => 'Test']];
        $this->pdoStatement->method('fetchAll')->willReturn($expectedResult);
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método getByWhere y comprobar que el resultado es el esperado
        $result = $this->orm->getByWhere('name', 'Test');
        $this->assertEquals($expectedResult, $result);
    }

    public function testDelete()
    {
        // No necesitamos que el método fetch o fetchAll devuelva algo, solo comprobar que se ejecuta
        $this->pdoStatement->expects($this->once())->method('execute');
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método delete
        $this->orm->delete(1);
    }

    public function testUpdate()
    {
        // No necesitamos que el método fetch o fetchAll devuelva algo, solo comprobar que se ejecuta
        $this->pdoStatement->expects($this->once())->method('execute');
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método update
        $data = ['name' => 'New Name'];
        $this->orm->update(1, $data);
    }

    public function testInsert()
    {
        // No necesitamos que el método fetch o fetchAll devuelva algo, solo comprobar que se ejecuta
        $this->pdoStatement->expects($this->once())->method('execute');
        
        // Configurar el mock del PDO para devolver el PDOStatement cuando se llame a prepare
        $this->pdo->method('prepare')->willReturn($this->pdoStatement);

        // Ejecutar el método insert
        $data = ['name' => 'New Entry'];
        $this->orm->insert($data);
    }
}
