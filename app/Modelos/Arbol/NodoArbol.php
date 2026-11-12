<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

//Nodo de un árbol binario: un valor y dos hijos opcionales.
final class NodoArbol
{
    public ?NodoArbol $izquierdo = null;
    public ?NodoArbol $derecho = null;

    public function __construct(public readonly string $valor)
    {
    }
}
