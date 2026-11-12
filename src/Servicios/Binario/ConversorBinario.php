<?php

declare(strict_types=1);

namespace App\Servicios\Binario;



// Conversión a binario mediante divisiones sucesivas entre 2
final class ConversorBinario implements Conversor
{
    // Los negativos se muestran con signo menos y el binario de su valor absoluto
    public function convertir(int $numero): string
    {
        $resultado = '';
        if ($numero === 0) {
            return '0';
        }
        $negativo = $numero < 0;
        $restante = $negativo ? -$numero : $numero;
        while ($restante > 0) {
            $resultado = ($restante % 2) . $resultado;
            $restante = intdiv($restante, 2);
        }
        return $negativo ? '-' . $resultado : $resultado;
    }
}
