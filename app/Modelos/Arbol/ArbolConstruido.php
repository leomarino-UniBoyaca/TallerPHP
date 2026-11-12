<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

//Resultado de construir un árbol: el árbol, qué recorridos se usaron y si el resultado es ambiguo.
final class ArbolConstruido
{
    public function __construct(
        public readonly ArbolBinario $arbol,
        public readonly string $usados,
        public readonly bool $ambiguo
    ) {
    }
}
