<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Operación de la calculadora: suma de los dos números.
final class Suma implements Operacion
{
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
