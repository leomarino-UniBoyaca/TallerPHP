<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Nodo de un árbol binario; no se modifica después de crearse
final class NodoArbol
{
    public function __construct(
        public readonly string $valor,
        public readonly ?NodoArbol $izquierdo = null,
        public readonly ?NodoArbol $derecho = null
    ) {
    }
}
