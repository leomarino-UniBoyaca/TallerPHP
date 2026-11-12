<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;



// Guarda el historial en la sesión del usuario (el más reciente primero)
final class HistorialSesion implements RepositorioHistorial
{
    private const CLAVE = 'historial_calculadora';
    private const MAXIMO = 50;



    // Agrega un registro al inicio y descarta los más antiguos
    public function agregar(string $registro): void
    {
        $actual = $this->listar();
        $nuevo = [$registro];
        for ($i = 0; $i < count($actual) && count($nuevo) < self::MAXIMO; $i++) {
            $nuevo[] = $actual[$i];
        }
        $_SESSION[self::CLAVE] = $nuevo;
    }



    public function listar(): array
    {
        $datos = $_SESSION[self::CLAVE] ?? [];
        return is_array($datos) ? array_values($datos) : [];
    }



    public function limpiar(): void
    {
        $_SESSION[self::CLAVE] = [];
    }
}
