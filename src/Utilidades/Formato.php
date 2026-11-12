<?php

declare(strict_types=1);

namespace App\Utilidades;



// Convierte valores a texto para mostrarlos en pantalla
final class Formato
{
    // Muestra un decimal sin ceros sobrantes (máximo 10 decimales)
    public static function numero(float $valor): string
    {
        $resultado = number_format(round($valor, 10), 10, '.', '');
        $resultado = rtrim(rtrim($resultado, '0'), '.');
        if ($resultado === '' || $resultado === '-0') {
            $resultado = '0';
        }
        return $resultado;
    }



    // Muestra una lista como conjunto matemático, por ejemplo {1, 2, 3}
    public static function conjunto(array $elementos): string
    {
        if (count($elementos) === 0) {
            return '{ } (conjunto vacío)';
        }
        return '{' . implode(', ', $elementos) . '}';
    }
}
