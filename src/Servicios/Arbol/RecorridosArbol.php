<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Calcula los tres recorridos de un árbol ya construido
final class RecorridosArbol
{
    // Raíz, izquierda, derecha
    public function preorden(?NodoArbol $nodo): array
    {
        $resultado = [];
        $this->recorrerPre($nodo, $resultado);
        return $resultado;
    }



    // Izquierda, raíz, derecha
    public function inorden(?NodoArbol $nodo): array
    {
        $resultado = [];
        $this->recorrerIn($nodo, $resultado);
        return $resultado;
    }



    // Izquierda, derecha, raíz
    public function postorden(?NodoArbol $nodo): array
    {
        $resultado = [];
        $this->recorrerPost($nodo, $resultado);
        return $resultado;
    }



    // Apoyo de preorden
    private function recorrerPre(?NodoArbol $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $salida[] = $nodo->valor;
        $this->recorrerPre($nodo->izquierdo, $salida);
        $this->recorrerPre($nodo->derecho, $salida);
    }



    // Apoyo de inorden
    private function recorrerIn(?NodoArbol $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $this->recorrerIn($nodo->izquierdo, $salida);
        $salida[] = $nodo->valor;
        $this->recorrerIn($nodo->derecho, $salida);
    }



    // Apoyo de postorden
    private function recorrerPost(?NodoArbol $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $this->recorrerPost($nodo->izquierdo, $salida);
        $this->recorrerPost($nodo->derecho, $salida);
        $salida[] = $nodo->valor;
    }
}
