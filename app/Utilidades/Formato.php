<?php

declare(strict_types=1);

namespace App\Utilidades;

//Convierte números y conjuntos a texto para mostrarlos en pantalla.
final class Formato
{
    //Muestra un decimal sin ceros sobrantes (2.50 se muestra 2.5 y 3.0 se muestra 3).
    public static function numero(float $numero): string
    {
        $texto = rtrim(rtrim(number_format($numero, 10, '.', ''), '0'), '.');

        if ($texto === '' || $texto === '-0') {
            return '0';
        }

        return $texto;
    }

    //Muestra una lista de enteros como conjunto: {1, 2, 3}.
    public static function conjunto(array $elementos): string
    {
        return '{' . implode(', ', $elementos) . '}';
    }
}
