<?php

declare(strict_types=1);

namespace App\Servicios\Estadistica;



// Contrato de una medida estadística; devuelve una lista porque la moda puede tener varios valores
interface MedidaEstadistica
{
    public function nombre(): string;

    public function calcular(array $numeros): array;
}
