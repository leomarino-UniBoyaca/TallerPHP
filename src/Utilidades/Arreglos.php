<?php

declare(strict_types=1);

namespace App\Utilidades;



// Operaciones sencillas sobre listas, recorridas siempre con ciclos for
final class Arreglos
{
    // Devuelve la posición de un valor en la lista o -1 si no existe
    public static function buscar(array $lista, mixed $valor): int
    {
        $resultado = -1;
        for ($i = 0; $i < count($lista); $i++) {
            if ($lista[$i] === $valor) {
                $resultado = $i;
                break;
            }
        }
        return $resultado;
    }



    // Indica si un valor está dentro de la lista (usa buscar)
    public static function contiene(array $lista, mixed $valor): bool
    {
        return self::buscar($lista, $valor) >= 0;
    }



    // Quita los valores repetidos conservando el primer orden de aparición
    public static function sinRepetidos(array $lista): array
    {
        $resultado = [];
        for ($i = 0; $i < count($lista); $i++) {
            if (!self::contiene($resultado, $lista[$i])) {
                $resultado[] = $lista[$i];
            }
        }
        return $resultado;
    }



    // Ordena de menor a mayor por inserción
    public static function ordenar(array $lista): array
    {
        $resultado = array_values($lista);
        for ($i = 1; $i < count($resultado); $i++) {
            $actual = $resultado[$i];
            $j = $i - 1;
            while ($j >= 0 && $resultado[$j] > $actual) {
                $resultado[$j + 1] = $resultado[$j];
                $j--;
            }
            $resultado[$j + 1] = $actual;
        }
        return $resultado;
    }



    // Copia una parte de la lista desde un inicio y con una longitud opcional
    public static function cortar(array $lista, int $inicio, ?int $longitud = null): array
    {
        $resultado = [];
        $fin = $longitud === null ? count($lista) : min(count($lista), $inicio + max(0, $longitud));
        for ($i = $inicio; $i < $fin; $i++) {
            $resultado[] = $lista[$i];
        }
        return $resultado;
    }
}
