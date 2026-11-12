<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;

use App\Nucleo\ErrorDeEntrada;
use App\Utilidades\Arreglos;



// Construye con preorden (primero) e inorden (segundo)
final class ConstructorPreIn implements ConstructorArbol
{
    // La raíz es el primer elemento del preorden; el inorden separa los lados
    public function construir(array $primero, array $segundo): ?NodoArbol
    {
        if (count($primero) === 0) {
            return null;
        }
        $raiz = $primero[0];
        $posicion = Arreglos::buscar($segundo, $raiz);
        if ($posicion < 0) {
            throw new ErrorDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }
        $izquierdo = $this->construir(
            Arreglos::cortar($primero, 1, $posicion),
            Arreglos::cortar($segundo, 0, $posicion)
        );
        $derecho = $this->construir(
            Arreglos::cortar($primero, $posicion + 1),
            Arreglos::cortar($segundo, $posicion + 1)
        );
        return new NodoArbol($raiz, $izquierdo, $derecho);
    }
}
