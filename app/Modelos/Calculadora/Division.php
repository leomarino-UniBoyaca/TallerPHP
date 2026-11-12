<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

use App\Nucleo\ExcepcionDeEntrada;

//Operación de la calculadora: cociente del primer número entre el segundo.
final class Division implements Operacion
{
    public function nombre(): string
    {
        return 'División';
    }

    public function simbolo(): string
    {
        return '÷';
    }

    //No se permite dividir entre cero.
    public function calcular(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new ExcepcionDeEntrada('No es posible dividir entre cero.');
        }

        return $a / $b;
    }
}
