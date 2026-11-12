<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



// Calcula el porcentaje a de b (por ejemplo, 15 % de 200 es 30)
final class Porcentaje implements Operacion
{
    public function clave(): string
    {
        return 'porcentaje';
    }



    public function nombre(): string
    {
        return 'Porcentaje (a % de b)';
    }



    public function simbolo(): string
    {
        return '% de';
    }



    public function calcular(float $a, float $b): float
    {
        return $a * $b / 100;
    }
}
