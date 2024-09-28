<?php

// Obtenemos la URL solicitada (sin el dominio)
$request = $_SERVER['REQUEST_URI'];

// Sanitizamos la URL para eliminar parámetros GET (si los hay)
$request = strtok($request, '?');
