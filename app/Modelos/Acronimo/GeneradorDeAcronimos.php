<?php

declare(strict_types=1);

namespace App\Modelos\Acronimo;

use App\Nucleo\ExcepcionDeEntrada;

//Convierte una frase en su acrónimo (Portable Network Graphics pasa a PNG).
final class GeneradorDeAcronimos
{
    //Los guiones separan palabras y los demás signos de puntuación se eliminan.
    public function generar(string $frase): string
    {
        $texto = preg_replace('/\p{Pd}/u', ' ', $frase);
        $texto = $texto === null ? null : preg_replace('/[^\p{L}\p{N}\s]/u', '', $texto);

        if ($texto === null) {
            throw new ExcepcionDeEntrada('El texto contiene caracteres no válidos.');
        }

        $palabras = preg_split('/\s+/u', trim($texto), -1, PREG_SPLIT_NO_EMPTY);

        if ($palabras === false || count($palabras) === 0) {
            throw new ExcepcionDeEntrada('La frase no contiene palabras.');
        }

        $res = '';

        for ($i = 0; $i < count($palabras); $i++) {
            $res .= mb_strtoupper(mb_substr($palabras[$i], 0, 1, 'UTF-8'), 'UTF-8');
        }

        return $res;
    }
}
