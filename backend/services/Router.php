<?php

class Router
{
    private $routes = [];
    private $notFound;

    // Agregar rutas al enrutador, con soporte para parámetros como {id}
    public function add($route, $action)
    {
        $route = preg_replace('/\{(\w+)\}/', '(?P<\1>[^\/]+)', $route); // Usar grupos con nombre
        $this->routes["#^$route$#"] = $action;
    }

    // Definir una ruta 404 por defecto
    public function setNotFound($action)
    {
        $this->notFound = $action;
    }

    // Resolver la solicitud y extraer parámetros si es necesario
    public function resolve($requestUri, $conexion)
    {
        $request = strtok($requestUri, '?');

        foreach ($this->routes as $route => $action) {
            if (preg_match($route, $request, $matches)) {
                list($controller, $method) = explode('@', $action);
                require_once "../backend/controllers/$controller.php";
                $controllerInstance = new $controller($conexion);

                // Filtrar $matches para obtener solo los parámetros capturados
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $params);
                    return;
                } else {
                    $this->handleNotFound();
                    return;
                }
            }
        }

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
