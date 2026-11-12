<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



final class Multiplicacion implements Operacion
{
    public function clave(): string
    {
        return 'multiplicacion';
    }



    public function nombre(): string
    {
        return 'Multiplicación';
    }



    public function simbolo(): string
    {
        return '×';
    }



    public function calcular(float $a, float $b): float
    {
        return $a * $b;
    }
}
