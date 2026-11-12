<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

//Árbol binario con sus tres recorridos; lo producen las estrategias de construcción.
final class ArbolBinario
{
    public function __construct(private ?NodoArbol $raiz)
    {
    }

    //Recorrido: raíz, izquierdo, derecho.
    public function preorden(): array
    {
        $res = [];
        $this->recorrerPre($this->raiz, $res);

        return $res;
    }

    //Recorrido: izquierdo, raíz, derecho.
    public function inorden(): array
    {
        $res = [];
        $this->recorrerIn($this->raiz, $res);

        return $res;
    }

    //Recorrido: izquierdo, derecho, raíz.
    public function postorden(): array
    {
        $res = [];
        $this->recorrerPost($this->raiz, $res);

        return $res;
    }

    //Indica si algún nodo tiene un solo hijo (con preorden y postorden esto vuelve ambiguo el árbol).
    public function tieneNodosConUnHijo(): bool
    {
        return $this->buscarUnHijo($this->raiz);
    }

    //Apoyo de preorden().
    private function recorrerPre(?NodoArbol $nodo, array &$res): void
    {
        if ($nodo === null) {
            return;
        }

        $res[] = $nodo->valor;
        $this->recorrerPre($nodo->izquierdo, $res);
        $this->recorrerPre($nodo->derecho, $res);
    }

    //Apoyo de inorden().
    private function recorrerIn(?NodoArbol $nodo, array &$res): void
    {
        if ($nodo === null) {
            return;
        }

        $this->recorrerIn($nodo->izquierdo, $res);
        $res[] = $nodo->valor;
        $this->recorrerIn($nodo->derecho, $res);
    }

    //Apoyo de postorden().
    private function recorrerPost(?NodoArbol $nodo, array &$res): void
    {
        if ($nodo === null) {
            return;
        }

        $this->recorrerPost($nodo->izquierdo, $res);
        $this->recorrerPost($nodo->derecho, $res);
        $res[] = $nodo->valor;
    }

    //Apoyo de tieneNodosConUnHijo().
    private function buscarUnHijo(?NodoArbol $nodo): bool
    {
        if ($nodo === null) {
            return false;
        }

        if (($nodo->izquierdo === null) !== ($nodo->derecho === null)) {
            return true;
        }

        return $this->buscarUnHijo($nodo->izquierdo) || $this->buscarUnHijo($nodo->derecho);
    }
}
