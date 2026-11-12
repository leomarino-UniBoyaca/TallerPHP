<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

use App\Nucleo\Sesion;

//Historial guardado en la sesión del navegador (se conserva al recargar la página).
final class HistorialEnSesion implements HistorialDeOperaciones
{
    private const CLAVE = 'historial_calculadora';
    private const MAXIMO = 100;

    public function __construct(private Sesion $sesion)
    {
    }

    //Agrega al inicio y conserva solo las últimas 100 operaciones.
    public function agregar(string $linea): void
    {
        $lista = $this->todas();
        array_unshift($lista, $linea);
        $this->sesion->guardar(self::CLAVE, array_slice($lista, 0, self::MAXIMO));
    }

    public function todas(): array
    {
        $lista = $this->sesion->obtener(self::CLAVE, []);

        return is_array($lista) ? $lista : [];
    }

    public function borrar(): void
    {
        $this->sesion->guardar(self::CLAVE, []);
    }
}
