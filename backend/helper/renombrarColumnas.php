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
