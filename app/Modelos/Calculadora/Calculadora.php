<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

use App\Nucleo\ExcepcionDeEntrada;

//Ejecuta la operación elegida; no conoce las operaciones concretas, solo el contrato Operacion.
final class Calculadora
{
    //Operaciones disponibles, indexadas por su clave.
    private array $operaciones;

    public function __construct(array $operaciones)
    {
        $this->operaciones = $operaciones;
    }

    //Lista clave y nombre de cada operación (para el selector del formulario).
    public function nombres(): array
    {
        $res = [];

        foreach ($this->operaciones as $clave => $operacion) {
            $res[$clave] = $operacion->nombre();
        }

        return $res;
    }

    //Busca la operación por su clave.
    public function operacion(string $clave): Operacion
    {
        if (!isset($this->operaciones[$clave])) {
            throw new ExcepcionDeEntrada('La operación seleccionada no es válida.');
        }

        return $this->operaciones[$clave];
    }

    //Calcula y verifica que el resultado sea un número finito.
    public function calcular(string $clave, float $a, float $b): float
    {
        $res = $this->operacion($clave)->calcular($a, $b);

        if (!is_finite($res)) {
            throw new ExcepcionDeEntrada('El resultado está fuera del rango permitido.');
        }

        return $res;
    }
}
