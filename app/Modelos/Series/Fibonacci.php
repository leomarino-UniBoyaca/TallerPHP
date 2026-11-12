<?php

declare(strict_types=1);

namespace App\Modelos\Series;

use App\Utilidades\NumeroGrande;

//Sucesión de Fibonacci: 0, 1, 1, 2, 3, 5...
final class Fibonacci implements GeneradorDeSerie
{
    public function nombre(): string
    {
        return 'Sucesión de Fibonacci';
    }

    public function notacion(int $n): string
    {
        return 'F(' . $n . ')';
    }

    //Cada término es la suma de los dos anteriores (usa NumeroGrande para no desbordar).
    public function generar(int $n): array
    {
        $serie = ['0'];

        if ($n >= 1) {
            $serie[] = '1';
        }

        for ($i = 2; $i <= $n; $i++) {
            $serie[] = NumeroGrande::sumar($serie[$i - 1], $serie[$i - 2]);
        }

        return $serie;
    }
}
