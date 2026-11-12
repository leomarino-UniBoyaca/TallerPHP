<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Contrato para representar un árbol de forma gráfica
interface DibujanteArbol
{
    public function dibujar(NodoArbol $raiz): string;
}
