<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



final class Suma implements Operacion
{
    public function clave(): string
    {
        return 'suma';
    }



    public function nombre(): string
    {
        return 'Suma';
    }



    public function simbolo(): string
    {
        return '+';
    }



    public function calcular(float $a, float $b): float
    {
        return $a + $b;
    }
}
