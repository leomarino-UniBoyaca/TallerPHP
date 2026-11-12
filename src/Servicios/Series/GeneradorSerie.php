<?php

declare(strict_types=1);

namespace App\Servicios\Series;



// Contrato de una serie numérica; agregar una nueva serie solo requiere otra clase que lo cumpla
interface GeneradorSerie
{
    public function clave(): string;

    public function nombre(): string;

    public function maximo(): int;

    public function generar(int $n): array;
}
