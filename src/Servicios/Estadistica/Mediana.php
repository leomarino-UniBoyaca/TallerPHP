<?php

declare(strict_types=1);

namespace App\Servicios\Estadistica;

use App\Utilidades\Arreglos;



// Valor central de la serie ordenada
final class Mediana implements MedidaEstadistica
{
    public function nombre(): string
    {
        return 'Mediana (valor central)';
    }



    // Con cantidad par se promedian los dos valores centrales
    public function calcular(array $numeros): array
    {
        $ordenados = Arreglos::ordenar($numeros);
        $total = count($ordenados);
        $medio = intdiv($total, 2);
        if ($total % 2 === 1) {
            return [$ordenados[$medio]];
        }
        return [($ordenados[$medio - 1] + $ordenados[$medio]) / 2];
    }
}
