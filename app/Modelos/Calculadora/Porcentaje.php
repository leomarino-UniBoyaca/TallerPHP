<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Operación de la calculadora: calcula qué parte representa un porcentaje del segundo número.
final class Porcentaje implements Operacion
{
    public function nombre(): string
    {
        return 'Porcentaje (A % de B)';
    }

    public function simbolo(): string
    {
        return '% de';
    }

    //El primer número es el porcentaje y el segundo es la cantidad sobre la que se aplica.
    public function calcular(float $a, float $b): float
    {
        return $a * $b / 100;
    }
}
