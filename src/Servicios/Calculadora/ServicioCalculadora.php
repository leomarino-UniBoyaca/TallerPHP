<?php

declare(strict_types=1);

namespace App\Servicios\Calculadora;

use App\Nucleo\ErrorDeEntrada;
use App\Utilidades\Formato;



// Ejecuta la operación elegida y registra el resultado en el historial
final class ServicioCalculadora
{
    /** @var array<string, Operacion> */
    private array $operaciones = [];



    public function __construct(array $operaciones, private RepositorioHistorial $historial)
    {
        for ($i = 0; $i < count($operaciones); $i++) {
            $this->operaciones[$operaciones[$i]->clave()] = $operaciones[$i];
        }
    }



    public function operaciones(): array
    {
        return array_values($this->operaciones);
    }



    // Calcula, guarda el registro y lo devuelve como texto
    public function calcular(string $clave, float $a, float $b): string
    {
        if (!isset($this->operaciones[$clave])) {
            throw new ErrorDeEntrada('Debe seleccionarse una operación válida.');
        }
        $operacion = $this->operaciones[$clave];
        $resultado = $operacion->calcular($a, $b);
        if (!is_finite($resultado)) {
            throw new ErrorDeEntrada('El resultado excede el rango permitido.');
        }
        $registro = Formato::numero($a) . ' ' . $operacion->simbolo() . ' ' . Formato::numero($b) . ' = ' . Formato::numero($resultado);
        $this->historial->agregar($registro);
        return $registro;
    }



    public function historial(): array
    {
        return $this->historial->listar();
    }



    public function borrarHistorial(): void
    {
        $this->historial->limpiar();
    }
}
