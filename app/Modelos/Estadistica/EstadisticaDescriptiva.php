<?php

declare(strict_types=1);

namespace App\Modelos\Estadistica;

use App\Nucleo\ExcepcionDeEntrada;

//Calcula promedio, mediana y moda de una serie de números reales.
final class EstadisticaDescriptiva
{
    private array $valores;

    public function __construct(array $valores)
    {
        if (count($valores) === 0) {
            throw new ExcepcionDeEntrada('Se requiere al menos un valor.');
        }

        $this->valores = array_values($valores);
    }

    //Promedio: suma de los valores dividida entre la cantidad.
    public function promedio(): float
    {
        $suma = 0.0;

        for ($i = 0; $i < count($this->valores); $i++) {
            $suma += $this->valores[$i];
        }

        return $suma / count($this->valores);
    }

    //Mediana: valor central de la serie ordenada (promedio de los dos centrales si la cantidad es par).
    public function mediana(): float
    {
        $orden = $this->valores;
        sort($orden);
        $n = count($orden);
        $medio = intdiv($n, 2);

        if ($n % 2 === 1) {
            return $orden[$medio];
        }

        return ($orden[$medio - 1] + $orden[$medio]) / 2;
    }

    //Moda: valores que más se repiten; si ningún valor sobresale en frecuencia devuelve una lista vacía.
    public function moda(): array
    {
        $frecuencias = [];
        $originales = [];

        for ($i = 0; $i < count($this->valores); $i++) {
            $clave = sprintf('%.10F', $this->valores[$i]);
            $frecuencias[$clave] = ($frecuencias[$clave] ?? 0) + 1;
            $originales[$clave] = $this->valores[$i];
        }

        $maxima = max($frecuencias);
        $distintos = count($frecuencias);
        $res = [];

        foreach ($frecuencias as $clave => $cantidad) {
            if ($cantidad === $maxima) {
                $res[] = $originales[$clave];
            }
        }

        if ($maxima === 1 || (count($res) === $distintos && $distintos > 1)) {
            return [];
        }

        sort($res);

        return $res;
    }
}
