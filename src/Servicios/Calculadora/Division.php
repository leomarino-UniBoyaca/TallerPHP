<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;

use App\Nucleo\ErrorDeEntrada;



final class Division implements Operacion
{
    public function clave(): string
    {
        return 'division';
    }



    public function nombre(): string
    {
        return 'División';
    }



    public function simbolo(): string
    {
        return '÷';
    }



    // No permite dividir entre cero
    public function calcular(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new ErrorDeEntrada('No es posible dividir entre cero.');
        }
        return $a / $b;
    }
}
