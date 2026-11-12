<?php

declare(strict_types=1);

namespace App\Utilidades;

use App\Nucleo\ErrorDeEntrada;



// Valida y convierte los textos que escribe el usuario
final class Validador
{
    // Convierte un texto a entero con un máximo de dígitos
    public static function entero(string $texto, int $maxDigitos, string $campo): int
    {
        if (preg_match('/^-?\d{1,' . $maxDigitos . '}$/', $texto) !== 1) {
            throw new ErrorDeEntrada("El campo \"$campo\" debe ser un número entero de máximo $maxDigitos dígitos.");
        }
        return (int) $texto;
    }



    // Convierte un texto a número real (acepta punto o coma decimal)
    public static function decimal(string $texto, string $campo): float
    {
        $normal = str_replace(',', '.', trim($texto));
        if ($normal === '' || !is_numeric($normal)) {
            throw new ErrorDeEntrada("El campo \"$campo\" debe ser un número válido.");
        }
        $valor = (float) $normal;
        if (!is_finite($valor)) {
            throw new ErrorDeEntrada("El campo \"$campo\" excede el rango permitido.");
        }
        return $valor;
    }



    // Separa un texto en elementos (por espacios, comas o punto y coma) y acepta flechas
    public static function elementos(string $texto): array
    {
        $limpio = str_replace(['→', '->'], ' ', $texto);
        $partes = preg_split('/[\s,;]+/u', $limpio, -1, PREG_SPLIT_NO_EMPTY);
        return $partes === false ? [] : $partes;
    }



    // Convierte un texto en una lista de enteros (usa entero para cada elemento)
    public static function listaEnteros(string $texto, string $campo, int $maxElementos): array
    {
        $partes = preg_split('/[\s,;]+/', $texto, -1, PREG_SPLIT_NO_EMPTY);
        if ($partes === false || count($partes) === 0) {
            throw new ErrorDeEntrada("El campo \"$campo\" debe contener al menos un número entero.");
        }
        if (count($partes) > $maxElementos) {
            throw new ErrorDeEntrada("El campo \"$campo\" admite máximo $maxElementos elementos.");
        }
        $resultado = [];
        for ($i = 0; $i < count($partes); $i++) {
            $resultado[] = self::entero($partes[$i], 15, $campo);
        }
        return $resultado;
    }
}
