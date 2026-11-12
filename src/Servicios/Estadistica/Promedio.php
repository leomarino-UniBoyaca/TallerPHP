<?php

declare(strict_types=1);

namespace App\Servicios\Estadistica;



// Media aritmética de la serie
final class Promedio implements MedidaEstadistica
{
    public function nombre(): string
    {
        return 'Promedio (media aritmética)';
    }



    // Suma todos los valores y divide entre la cantidad
    public function calcular(array $numeros): array
    {
        $suma = 0.0;
        for ($i = 0; $i < count($numeros); $i++) {
            $suma += $numeros[$i];
        }
        return [$suma / count($numeros)];
    }
}
