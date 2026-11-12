<?php

declare(strict_types=1);

namespace App\Modelos\Binario;

//Convierte un número entero a su representación en binario.
final class ConversorBinario
{
    //Divide entre 2 de forma repetida y junta los residuos; los negativos llevan signo menos.
    public function convertir(int $numero): string
    {
        if ($numero === 0) {
            return '0';
        }

        $negativo = $numero < 0;
        $resto = $negativo ? -$numero : $numero;
        $res = '';

        while ($resto > 0) {
            $res = (string) ($resto % 2) . $res;
            $resto = intdiv($resto, 2);
        }

        return $negativo ? '-' . $res : $res;
    }
}
