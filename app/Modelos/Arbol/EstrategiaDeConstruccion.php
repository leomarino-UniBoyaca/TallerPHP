<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

//Contrato de las formas de construir un árbol a partir de dos recorridos.
interface EstrategiaDeConstruccion
{
    //Nombre de la pareja de recorridos que usa (se muestra en pantalla).
    public function descripcion(): string;

    //Arma el árbol; recibe los recorridos en el orden que indica la descripción.
    public function construir(array $primero, array $segundo): ?NodoArbol;

    //Revisa que el árbol armado reproduzca exactamente los recorridos recibidos.
    public function coincide(ArbolBinario $arbol, array $primero, array $segundo): bool;
}
