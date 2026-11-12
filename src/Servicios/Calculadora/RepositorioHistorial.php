<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



// Contrato para guardar el historial; permite cambiar la sesión por otro medio sin tocar la calculadora
interface RepositorioHistorial
{
    public function agregar(string $registro): void;

    public function listar(): array;

    public function limpiar(): void;
}
