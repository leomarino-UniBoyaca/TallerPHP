<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Datos que devuelve el servicio al construir un árbol
final class ResultadoArbol
{
    public function __construct(
        public readonly NodoArbol $raiz,
        public readonly string $metodo,
        public readonly string $aviso,
        public readonly array $preorden,
        public readonly array $inorden,
        public readonly array $postorden
    ) {
    }
}
