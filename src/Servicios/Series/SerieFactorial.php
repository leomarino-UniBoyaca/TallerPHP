<?php

declare(strict_types=1);

namespace App\Servicios\Series;



// Factoriales desde 0! hasta n!
final class SerieFactorial implements GeneradorSerie
{
    public function clave(): string
    {
        return 'factorial';
    }



    public function nombre(): string
    {
        return 'Factorial';
    }



    // Con 20 el valor aún cabe en un entero de 64 bits
    public function maximo(): int
    {
        return 20;
    }



    // Cada factorial es el anterior multiplicado por la posición actual
    public function generar(int $n): array
    {
        $resultado = [1];
        $producto = 1;
        for ($i = 1; $i <= $n; $i++) {
            $producto *= $i;
            $resultado[] = $producto;
        }
        return $resultado;
    }
}
