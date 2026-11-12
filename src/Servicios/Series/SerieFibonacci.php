<?php

declare(strict_types=1);

namespace App\Servicios\Series;



// Sucesión de Fibonacci desde la posición 0 hasta la posición n
final class SerieFibonacci implements GeneradorSerie
{
    public function clave(): string
    {
        return 'fibonacci';
    }



    public function nombre(): string
    {
        return 'Sucesión de Fibonacci';
    }



    // Con 90 el valor aún cabe en un entero de 64 bits
    public function maximo(): int
    {
        return 90;
    }



    // Cada término es la suma de los dos anteriores
    public function generar(int $n): array
    {
        $resultado = [];
        $anterior = 0;
        $actual = 1;
        for ($i = 0; $i <= $n; $i++) {
            $resultado[] = $anterior;
            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }
        return $resultado;
    }
}
