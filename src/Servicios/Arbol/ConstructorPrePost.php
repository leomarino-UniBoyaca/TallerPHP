<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;

use App\Nucleo\ErrorDeEntrada;
use App\Utilidades\Arreglos;



// Construye con preorden (primero) y postorden (segundo); si hay ambigüedad, el hijo único se toma como izquierdo
final class ConstructorPrePost implements ConstructorArbol
{
    // El segundo elemento del preorden es la raíz del subárbol izquierdo y su posición en el postorden da el tamaño
    public function construir(array $primero, array $segundo): ?NodoArbol
    {
        $total = count($primero);
        if ($total === 0) {
            return null;
        }
        $raiz = $primero[0];
        if ($segundo[$total - 1] !== $raiz) {
            throw new ErrorDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }
        if ($total === 1) {
            return new NodoArbol($raiz);
        }
        $posicion = Arreglos::buscar($segundo, $primero[1]);
        if ($posicion < 0 || $posicion > $total - 2) {
            throw new ErrorDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }
        $tamano = $posicion + 1;
        $izquierdo = $this->construir(
            Arreglos::cortar($primero, 1, $tamano),
            Arreglos::cortar($segundo, 0, $tamano)
        );
        $derecho = $this->construir(
            Arreglos::cortar($primero, 1 + $tamano),
            Arreglos::cortar($segundo, $tamano, $total - 1 - $tamano)
        );
        return new NodoArbol($raiz, $izquierdo, $derecho);
    }
}
