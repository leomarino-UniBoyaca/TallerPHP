<?php

declare(strict_types=1);

namespace App\Modelos\Arbol;

use App\Nucleo\ExcepcionDeEntrada;

//Elige la estrategia según los recorridos ingresados y valida el resultado.
final class ConstructorDeArbol
{
    public function __construct(
        private PreordenInorden $preInorden,
        private PreordenPostorden $prePostorden,
        private InordenPostorden $inPostorden
    ) {
    }

    //Prioridad: preorden e inorden (aunque se ingresen los tres), luego preorden y postorden, luego inorden y postorden.
    public function construir(array $pre, array $ino, array $post): ArbolConstruido
    {
        if (count($pre) > 0 && count($ino) > 0) {
            $estrategia = $this->preInorden;
            $primero = $pre;
            $segundo = $ino;
        } elseif (count($pre) > 0 && count($post) > 0) {
            $estrategia = $this->prePostorden;
            $primero = $pre;
            $segundo = $post;
        } elseif (count($ino) > 0 && count($post) > 0) {
            $estrategia = $this->inPostorden;
            $primero = $ino;
            $segundo = $post;
        } else {
            throw new ExcepcionDeEntrada('Se requieren como mínimo dos recorridos.');
        }

        $this->validar($primero, $segundo);

        $arbol = new ArbolBinario($estrategia->construir($primero, $segundo));

        if (!$estrategia->coincide($arbol, $primero, $segundo)) {
            throw new ExcepcionDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }

        $ambiguo = $estrategia === $this->prePostorden && $arbol->tieneNodosConUnHijo();

        return new ArbolConstruido($arbol, $estrategia->descripcion(), $ambiguo);
    }

    //Revisa que no haya nodos repetidos y que ambos recorridos tengan los mismos nodos.
    private function validar(array $primero, array $segundo): void
    {
        if (count(array_unique($primero)) !== count($primero) || count(array_unique($segundo)) !== count($segundo)) {
            throw new ExcepcionDeEntrada('Los nodos de un recorrido no pueden repetirse.');
        }

        $a = $primero;
        $b = $segundo;
        sort($a, SORT_STRING);
        sort($b, SORT_STRING);

        if ($a !== $b) {
            throw new ExcepcionDeEntrada('Los recorridos ingresados no contienen los mismos nodos.');
        }
    }
}
