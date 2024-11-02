<?php
function renombrarColumnas($datos, $mapaColumnas)
{
    foreach ($datos as &$fila) {
        foreach ($mapaColumnas as $columnaOriginal => $nuevoNombre) {
            if (isset($fila[$columnaOriginal])) {
                $fila[$nuevoNombre] = htmlspecialchars($fila[$columnaOriginal], ENT_QUOTES, 'UTF-8');
                unset($fila[$columnaOriginal]); // Eliminar la columna original
            }
        }
    }
    return $datos;
}
function createJsonFile($data, $fileName)
{
    $file = __DIR__ . '/../cache/' . $fileName . '.json';
    
    // Comprobar si el archivo ya existe y eliminarlo si es necesario
    if (file_exists($file)) {
        // Eliminar el archivo especificado
        unlink($file);
    }
    
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    
    if (file_put_contents($file, $jsonData) !== false) {
        return true; // El archivo se creó correctamente
    } else {
        return false; // Error al crear el archivo
    }
}
