<?php

// Obtenemos la URL solicitada (sin el dominio)
$request = $_SERVER['REQUEST_URI'];

// Sanitizamos la URL para eliminar parámetros GET (si los hay)
$request = strtok($request, '?');
// Obtener la fecha actual
$fechaActual = date('Y-m-d'); // Formato: Año-Mes-Día
$mesActual = date('m'); // Mes actual (01 a 12)
$anioActual = date('Y'); // Año actual