<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Operación de la calculadora: resta del segundo número al primero.
final class Resta implements Operacion
{
    public function nombre(): string
    {
        return 'Resta';
    }

    public function simbolo(): string
    {
        return '-';
    }

    public function calcular(float $a, float $b): float
    {
        return $a - $b;
    }
}
