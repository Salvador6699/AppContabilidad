<?php

class Router
{
    private $routes = [];
    private $notFound;

    // Agregar rutas al enrutador, con soporte para parámetros como {id}
    public function add($route, $action)
    {
        // Reemplazar {parametro} por una expresión regular
        $route = preg_replace('/\{(\w+)\}/', '(\d+)', $route);
        $this->routes[$route] = $action;
    }

    // Definir una ruta 404 por defecto
    public function setNotFound($action)
    {
        $this->notFound = $action;
    }

    // Resolver la solicitud y extraer parámetros si es necesario
    public function resolve($requestUri, $conexion)
    {
        // Quitar parámetros de la query string
        $request = strtok($requestUri, '?');

        foreach ($this->routes as $route => $action) {
            // Comprobar si la ruta coincide con la solicitud
            if (preg_match("#^$route$#", $request, $matches)) {
                // Si hay parámetros capturados, extraerlos
                array_shift($matches); // Eliminar el primer elemento, que es la URL completa

                list($controller, $method) = explode('@', $action);

                // Incluir el archivo del controlador
                require_once "../backend/controllers/$controller.php";

                // Crear una instancia del controlador
                $controllerInstance = new $controller($conexion);

                // Comprobar si el método existe en el controlador
                if (method_exists($controllerInstance, $method)) {
                    // Llamar al método con los parámetros capturados
                    call_user_func_array([$controllerInstance, $method], $matches);
                } else {
                    // Manejar el error 404 si el método no existe
                    $this->handleNotFound();
                    return;
                }
            }
        }

        // Si no se encuentra la ruta, manejar el error 404
        $this->handleNotFound();
    }

    // Método para manejar la respuesta 404
    private function handleNotFound()
    {
        if ($this->notFound) {
            list($controller, $method) = explode('@', $this->notFound);
            require_once "../backend/controllers/$controller.php";
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            http_response_code(404);
            echo "Página no encontrada";
        }
    }
}
