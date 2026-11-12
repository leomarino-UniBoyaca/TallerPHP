<?php

declare(strict_types=1);

namespace App\Utilidades;

//Operaciones con números muy largos guardados como texto (Fibonacci y factorial superan el límite de int).
final class NumeroGrande
{
    //Suma dos números positivos escritos como texto.
    public static function sumar(string $a, string $b): string
    {
        $res = '';
        $acarreo = 0;
        $i = strlen($a) - 1;
        $j = strlen($b) - 1;

        while ($i >= 0 || $j >= 0 || $acarreo > 0) {
            $suma = $acarreo;

            if ($i >= 0) {
                $suma += (int) $a[$i];
                $i--;
            }

            if ($j >= 0) {
                $suma += (int) $b[$j];
                $j--;
            }

            $res = (string) ($suma % 10) . $res;
            $acarreo = intdiv($suma, 10);
        }

        return $res === '' ? '0' : $res;
    }

    //Multiplica un número escrito como texto por un entero pequeño.
    public static function multiplicar(string $a, int $factor): string
    {
        if ($factor === 0) {
            return '0';
        }

        $res = '';
        $acarreo = 0;

        for ($i = strlen($a) - 1; $i >= 0; $i--) {
            $producto = ((int) $a[$i]) * $factor + $acarreo;
            $res = (string) ($producto % 10) . $res;
            $acarreo = intdiv($producto, 10);
        }

        while ($acarreo > 0) {
            $res = (string) ($acarreo % 10) . $res;
            $acarreo = intdiv($acarreo, 10);
        }

        return $res;
    }
}
