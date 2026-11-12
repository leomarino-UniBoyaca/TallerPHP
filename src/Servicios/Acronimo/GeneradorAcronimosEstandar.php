<?php

declare(strict_types=1);

namespace App\Servicios\Acronimo;

use App\Nucleo\ErrorDeEntrada;



// Toma la primera letra de cada palabra; el guion separa palabras y los demás signos se eliminan
final class GeneradorAcronimosEstandar implements GeneradorAcronimos
{
    private const LONGITUD_MAXIMA = 200;



    // Convierte la frase en su acrónimo en mayúsculas
    public function generar(string $frase): string
    {
        $resultado = '';
        if (mb_strlen($frase) > self::LONGITUD_MAXIMA) {
            throw new ErrorDeEntrada('La frase admite máximo ' . self::LONGITUD_MAXIMA . ' caracteres.');
        }
        $limpia = str_replace('-', ' ', $frase);
        $limpia = preg_replace('/[^\p{L}\p{M}\p{N}\s]/u', '', $limpia);
        $palabras = preg_split('/\s+/u', trim((string) $limpia), -1, PREG_SPLIT_NO_EMPTY);
        if ($palabras === false || count($palabras) === 0) {
            throw new ErrorDeEntrada('Debe ingresarse una frase con al menos una palabra.');
        }
        for ($i = 0; $i < count($palabras); $i++) {
            $resultado .= mb_strtoupper(mb_substr($palabras[$i], 0, 1));
        }
        return $resultado;
    }
}
