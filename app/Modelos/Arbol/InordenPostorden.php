<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

use App\Nucleo\ExcepcionDeEntrada;

//Construcción con inorden y postorden (siempre produce un árbol único).
final class InordenPostorden implements EstrategiaDeConstruccion
{
    public function descripcion(): string
    {
        return 'inorden y postorden';
    }

    //La raíz es el último elemento del postorden; su posición en el inorden separa los dos subárboles.
    public function construir(array $ino, array $post): ?NodoArbol
    {
        if (count($post) === 0 || count($ino) === 0) {
            return null;
        }

        $n = count($post);
        $raiz = $post[$n - 1];
        $pos = array_search($raiz, $ino, true);

        if ($pos === false) {
            throw new ExcepcionDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }

        $nodo = new NodoArbol($raiz);
        $nodo->izquierdo = $this->construir(array_slice($ino, 0, $pos), array_slice($post, 0, $pos));
        $nodo->derecho = $this->construir(array_slice($ino, $pos + 1), array_slice($post, $pos, $n - 1 - $pos));

        return $nodo;
    }

    public function coincide(ArbolBinario $arbol, array $ino, array $post): bool
    {
        return $arbol->inorden() === $ino && $arbol->postorden() === $post;
    }
}
