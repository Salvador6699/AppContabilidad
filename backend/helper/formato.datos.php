<?php
function fecha($fecha, $formato)
{

    $meses_castellano = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    if ($fecha == null) {
        $hoy = date('d') . ' de ' . $meses_castellano[date('n') - 1];
        return $hoy;
    }
    //separamos la fecha en partes, suponiendo que las recibimos en el formato 2022-07-01
    $partes = explode("-", $fecha);
    $ano = $partes[0];  // 2022
    $mes = $partes[1]; // 07
    $dia = $partes[2];   // 01
    switch ($formato) {
        case 'mes_ano':
            $fecha = $meses_castellano[$mes - 1] . ' ' . $ano;
            break;
        case 'dia_mes_ano':
            $fecha = $dia . '-' . $meses_castellano[$mes - 1] . '-' . $ano;
            break;
        case 'dia_mes_letra':
            $fecha = $dia . ' de ' . $meses_castellano[$mes - 1];
            break;
        case 'dia_mes':
            $fecha = $dia . '/' . $mes;
            break;
            case 'mes':
                $fecha = $meses_castellano[$mes - 1];
                break;
    }
    return $fecha;
}
function moneda($cantidad)
{
    $cantidad = number_format($cantidad, 2, ",", '.') . ' €';
    return $cantidad;
}