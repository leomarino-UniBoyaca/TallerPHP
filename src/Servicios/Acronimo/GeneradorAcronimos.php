<?php

declare(strict_types=1);

namespace App\Servicios\Acronimo;



// Contrato para cualquier clase que convierta una frase en siglas
interface GeneradorAcronimos
{
    public function generar(string $frase): string;
}
