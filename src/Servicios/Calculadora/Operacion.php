<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



// Contrato de una operación aritmética; para agregar otra solo se crea una clase nueva
interface Operacion
{
    public function clave(): string;

    public function nombre(): string;

    public function simbolo(): string;

    public function calcular(float $a, float $b): float;
}
