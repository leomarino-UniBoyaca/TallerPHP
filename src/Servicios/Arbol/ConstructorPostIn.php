<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;

use App\Nucleo\ErrorDeEntrada;
use App\Utilidades\Arreglos;



// Construye con postorden (primero) e inorden (segundo)
final class ConstructorPostIn implements ConstructorArbol
{
    // La raíz es el último elemento del postorden; el inorden separa los lados
    public function construir(array $primero, array $segundo): ?NodoArbol
    {
        $total = count($primero);
        if ($total === 0) {
            return null;
        }
        $raiz = $primero[$total - 1];
        $posicion = Arreglos::buscar($segundo, $raiz);
        if ($posicion < 0) {
            throw new ErrorDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }
        $izquierdo = $this->construir(
            Arreglos::cortar($primero, 0, $posicion),
            Arreglos::cortar($segundo, 0, $posicion)
        );
        $derecho = $this->construir(
            Arreglos::cortar($primero, $posicion, $total - 1 - $posicion),
            Arreglos::cortar($segundo, $posicion + 1)
        );
        return new NodoArbol($raiz, $izquierdo, $derecho);
    }
}
