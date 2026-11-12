<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Contrato para construir un árbol a partir de dos recorridos
interface ConstructorArbol
{
    public function construir(array $primero, array $segundo): ?NodoArbol;
}
