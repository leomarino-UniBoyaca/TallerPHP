<?php

declare(strict_types=1);

namespace App\Controladores;



// Contrato de todo controlador: recibe la petición y muestra la respuesta
interface Controlador
{
    public function ejecutar(): void;
}
