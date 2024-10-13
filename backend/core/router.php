<?php
require_once(__DIR__.'/../services/conexion.php');
require_once(__DIR__.'/../services/Router.php');

// Crear una instancia de la clase Database
$db = new DatabaseConexion();
$conexion = $db->getConexion();

// Crear una instancia de Router
$router = new Router();

// Definir rutas con y sin parámetros
$router->add('/', 'HomeController@index');
$router->add('/user', 'UserController@index');
$router->add('/user/create', 'UserController@create');  
$router->add('/listar', 'UsuarioController@listar');
$router->add('/buscarUsuario','UsuarioController@buscarUsuario');
$router->add('/usuarios','UsuarioController@usuariosHome');

// Definir la ruta 404 por defecto
$router->setNotFound('ErrorController@home');

// Resolver la solicitud
$router->resolve($_SERVER['REQUEST_URI'], $conexion);
