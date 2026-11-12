<?php

declare(strict_types=1);

namespace App\Servicios\Binario;



// Contrato para convertir un entero a otra base
interface Conversor
{
    public function convertir(int $numero): string;
}
