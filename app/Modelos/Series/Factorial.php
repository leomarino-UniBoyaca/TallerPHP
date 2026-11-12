<?php

declare(strict_types=1);

namespace App\Modelos\Series;

use App\Utilidades\NumeroGrande;

//Serie de factoriales: 0!, 1!, 2!, 3!...
final class Factorial implements GeneradorDeSerie
{
    public function nombre(): string
    {
        return 'Factorial';
    }

    public function notacion(int $n): string
    {
        return $n . '!';
    }

    //Cada término es el anterior multiplicado por su posición (usa NumeroGrande para no desbordar).
    public function generar(int $n): array
    {
        $serie = ['1'];

        for ($i = 1; $i <= $n; $i++) {
            $serie[] = NumeroGrande::multiplicar($serie[$i - 1], $i);
        }

        return $serie;
    }
}
