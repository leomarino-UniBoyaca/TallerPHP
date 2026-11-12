<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

use App\Nucleo\ExcepcionDeEntrada;

//Construcción con preorden y postorden (el árbol no es único si algún nodo tiene un solo hijo).
final class PreordenPostorden implements EstrategiaDeConstruccion
{
    public function descripcion(): string
    {
        return 'preorden y postorden';
    }

    //El segundo elemento del preorden es la raíz del subárbol izquierdo; su posición en el postorden indica su tamaño.
    public function construir(array $pre, array $post): ?NodoArbol
    {
        $n = count($pre);

        if ($n === 0 || count($post) === 0) {
            return null;
        }

        $nodo = new NodoArbol($pre[0]);

        if ($n === 1) {
            return $nodo;
        }

        $pos = array_search($pre[1], $post, true);

        if ($pos === false) {
            throw new ExcepcionDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }

        $tamano = $pos + 1;
        $nodo->izquierdo = $this->construir(array_slice($pre, 1, $tamano), array_slice($post, 0, $tamano));
        $nodo->derecho = $this->construir(array_slice($pre, 1 + $tamano), array_slice($post, $tamano, $n - 1 - $tamano));

        return $nodo;
    }

    public function coincide(ArbolBinario $arbol, array $pre, array $post): bool
    {
        return $arbol->preorden() === $pre && $arbol->postorden() === $post;
    }
}
