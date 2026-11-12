<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

use App\Nucleo\ExcepcionDeEntrada;

//Construcción con preorden e inorden (siempre produce un árbol único).
final class PreordenInorden implements EstrategiaDeConstruccion
{
    public function descripcion(): string
    {
        return 'preorden e inorden';
    }

    //La raíz es el primer elemento del preorden; su posición en el inorden separa los dos subárboles.
    public function construir(array $pre, array $ino): ?NodoArbol
    {
        if (count($pre) === 0 || count($ino) === 0) {
            return null;
        }

        $pos = array_search($pre[0], $ino, true);

        if ($pos === false) {
            throw new ExcepcionDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }

        $nodo = new NodoArbol($pre[0]);
        $nodo->izquierdo = $this->construir(array_slice($pre, 1, $pos), array_slice($ino, 0, $pos));
        $nodo->derecho = $this->construir(array_slice($pre, 1 + $pos), array_slice($ino, $pos + 1));

        return $nodo;
    }

    public function coincide(ArbolBinario $arbol, array $pre, array $ino): bool
    {
        return $arbol->preorden() === $pre && $arbol->inorden() === $ino;
    }
}
