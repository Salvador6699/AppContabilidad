<?php

$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');

$routes = [
    '/' => 'HomeController@index',
    '/prueba' => 'HomeController@about',
    '/user' => 'UserController@index',
    '/user/create' => 'UserController@create'
];

if (array_key_exists($request, $routes)) {
    list($controller, $method) = explode('@', $routes[$request]);

    // Incluimos el archivo del controlador
    require "../backend/controllers/$controller.php";

    // Creamos una instancia del controlador
    $controllerInstance = new $controller();

    // Llamamos al método
    $controllerInstance->$method();
} else {
    // Si no se encuentra la ruta, mostramos un error 404
    http_response_code(404);
    $controller="ErrorController";
    $method="home";
    // Incluimos el archivo del controlador
    require "../backend/controllers/$controller.php";
    // Creamos una instancia del controlador
    $controllerInstance = new $controller();

    // Llamamos al método
    $controllerInstance->$method();
}

