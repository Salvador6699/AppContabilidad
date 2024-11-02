<?php
require_once(__DIR__.'/../services/conexion.php');
require_once(__DIR__.'/../services/Router.php');

// Crear una instancia de la clase Database
$db = new DatabaseConexion();
$conexion = $db->getConexion();

// Crear una instancia de Router
$router = new Router();

// Definir rutas con y sin parámetros
//home
$router->add('/', 'HomeController@index');
// Definir la ruta 404 por defecto
$router->setNotFound('ErrorController@home');
//usuarios
$router->add('/user', 'UserController@index');
$router->add('/user/create', 'UserController@create');  
$router->add('/json_usuarios', 'UsuarioController@getUsuarios');
$router->add('/buscarUsuario','UsuarioController@buscarUsuario');
$router->add('/usuarios','UsuarioController@usuariosHome');
//cuentas
$router->add('/cuentas','CuentasController@cuentasHome');
$router->add('/json_cuentas','CuentasController@getCuentas');
//movimientos
$router->add('/json_movimientos','MovimientosController@getMovimientos');
//balance
$router->add('/json_balance','BalanceController@getBalance');
//categorias
$router->add('/json_categorias','CategoriasController@getCategorias');
//subcategorias
$router->add('/json_subcategorias','SubcategoriasController@getSubcategorias');
//deuda
$router->add('/json_deudas','DeudaController@getDeuda');
//presupuestos
$router->add('/json_presupuestos','PresupuestosController@getPresupuestos');
//proyectos
$router->add('/json_proyectos','ProyectosController@getProyectos');
//tipoMovimiento
$router->add('/json_tipoMovimiento','TipoMovimientoController@getTipoMovimiento');

// Resolver la solicitud
$router->resolve($_SERVER['REQUEST_URI'], $conexion);
