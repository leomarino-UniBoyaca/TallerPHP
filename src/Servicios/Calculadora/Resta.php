<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



final class Resta implements Operacion
{
    public function clave(): string
    {
        return 'resta';
    }



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
