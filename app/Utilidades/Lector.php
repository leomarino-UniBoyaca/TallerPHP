<?php

declare(strict_types=1);

namespace App\Utilidades;

use App\Nucleo\ExcepcionDeEntrada;

//Convierte el texto escrito en los formularios en números o etiquetas; lo usan casi todos los controladores.
final class Lector
{
    private const MAXIMO_ELEMENTOS = 500;

    //Lee varios números reales separados por espacios, saltos de línea o punto y coma.
    public function reales(string $texto): array
    {
        $tokens = $this->separar($texto, '/[\s;]+/');
        $res = [];

        for ($i = 0; $i < count($tokens); $i++) {
            $res[] = $this->decimal($tokens[$i]);
        }

        return $res;
    }

    //Lee varios números enteros separados por espacios, comas o punto y coma.
    public function enteros(string $texto): array
    {
        $tokens = $this->separar($texto, '/[\s;,]+/');
        $res = [];

        for ($i = 0; $i < count($tokens); $i++) {
            $res[] = $this->entero($tokens[$i]);
        }

        return $res;
    }

    //Lee un solo número real; acepta punto o coma como separador decimal.
    public function decimal(string $texto): float
    {
        $limpio = trim($texto);

        if (substr_count($limpio, ',') === 1 && strpos($limpio, '.') === false) {
            $limpio = str_replace(',', '.', $limpio);
        }

        if (!preg_match('/^[+-]?(\d+(\.\d*)?|\.\d+)$/', $limpio)) {
            throw new ExcepcionDeEntrada('El valor "' . $this->recortar($texto) . '" no es un número válido.');
        }

        $numero = (float) $limpio;

        if (!is_finite($numero)) {
            throw new ExcepcionDeEntrada('El valor "' . $this->recortar($texto) . '" está fuera del rango permitido.');
        }

        return $numero;
    }

    //Lee un solo número entero (hasta 18 dígitos para evitar desbordamientos).
    public function entero(string $texto): int
    {
        $limpio = trim($texto);

        if (!preg_match('/^[+-]?\d+$/', $limpio)) {
            throw new ExcepcionDeEntrada('El valor "' . $this->recortar($texto) . '" no es un número entero válido.');
        }

        $digitos = ltrim(ltrim($limpio, '+-'), '0');

        if (strlen($digitos) > 18) {
            throw new ExcepcionDeEntrada('El valor "' . $this->recortar($texto) . '" está fuera del rango permitido.');
        }

        return (int) $limpio;
    }

    //Lee los nodos de un recorrido; los separan espacios, comas, punto y coma o flechas.
    public function etiquetas(string $texto): array
    {
        $partes = preg_split('/\s*(?:→|->|[,;])\s*|\s+/u', trim($texto), -1, PREG_SPLIT_NO_EMPTY);

        if ($partes === false) {
            throw new ExcepcionDeEntrada('El texto contiene caracteres no válidos.');
        }

        if (count($partes) > 60) {
            throw new ExcepcionDeEntrada('Se permiten como máximo 60 nodos por recorrido.');
        }

        return $partes;
    }

    //Divide el texto con la expresión dada y valida que haya al menos un elemento y no demasiados.
    private function separar(string $texto, string $patron): array
    {
        $partes = preg_split($patron, trim($texto), -1, PREG_SPLIT_NO_EMPTY);

        if ($partes === false || count($partes) === 0) {
            throw new ExcepcionDeEntrada('Se requiere al menos un valor.');
        }

        if (count($partes) > self::MAXIMO_ELEMENTOS) {
            throw new ExcepcionDeEntrada('Se permiten como máximo ' . self::MAXIMO_ELEMENTOS . ' valores.');
        }

        return $partes;
    }

    //Acorta textos largos para que el mensaje de error no ocupe toda la pantalla.
    private function recortar(string $texto): string
    {
        return mb_strimwidth(trim($texto), 0, 30, '...', 'UTF-8');
    }
}
