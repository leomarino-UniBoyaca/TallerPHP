<?php

declare(strict_types=1);

namespace App\Modelos\Conjuntos;

//Operaciones entre dos conjuntos de enteros; cada resultado se devuelve sin repetidos y ordenado.
final class OperacionesDeConjuntos
{
    //Elementos que están en A o en B.
    public function union(array $a, array $b): array
    {
        return $this->normalizar(array_merge($a, $b));
    }

    //Elementos que están en A y también en B.
    public function interseccion(array $a, array $b): array
    {
        $res = [];

        for ($i = 0; $i < count($a); $i++) {
            if (in_array($a[$i], $b, true)) {
                $res[] = $a[$i];
            }
        }

        return $this->normalizar($res);
    }

    //Elementos que están en A y no están en B (para B - A se invierten los argumentos).
    public function diferencia(array $a, array $b): array
    {
        $res = [];

        for ($i = 0; $i < count($a); $i++) {
            if (!in_array($a[$i], $b, true)) {
                $res[] = $a[$i];
            }
        }

        return $this->normalizar($res);
    }

    //Quita repetidos y ordena de menor a mayor; también lo usa el controlador para que A y B sean conjuntos.
    public function normalizar(array $elementos): array
    {
        $res = array_values(array_unique($elementos));
        sort($res);

        return $res;
    }
}
