<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Operación de la calculadora: producto de los dos números.
final class Multiplicacion implements Operacion
{
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
