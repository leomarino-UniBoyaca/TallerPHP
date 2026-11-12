<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;

use App\Nucleo\ErrorDeEntrada;
use App\Utilidades\Arreglos;



// Elige qué par de recorridos usar, valida los datos, construye el árbol y comprueba el resultado
final class ServicioArbol
{
    private const MAXIMO_NODOS = 100;



    public function __construct(
        private ConstructorArbol $preIn,
        private ConstructorArbol $postIn,
        private ConstructorArbol $prePost,
        private RecorridosArbol $recorridos
    ) {
    }



    // Con los tres recorridos se usa preorden e inorden; con dos se usan los ingresados
    public function construir(array $pre, array $in, array $post): ResultadoArbol
    {
        $usaPre = count($pre) > 0;
        $usaIn = count($in) > 0;
        $usaPost = count($post) > 0;
        if ((int) $usaPre + (int) $usaIn + (int) $usaPost < 2) {
            throw new ErrorDeEntrada('Deben ingresarse al menos dos recorridos.');
        }
        $esPrePost = false;
        if ($usaPre && $usaIn) {
            $constructor = $this->preIn;
            $primero = $pre;
            $segundo = $in;
            $metodo = 'preorden e inorden';
            $usaPost = false;
        } elseif ($usaIn && $usaPost) {
            $constructor = $this->postIn;
            $primero = $post;
            $segundo = $in;
            $metodo = 'postorden e inorden';
            $usaPre = false;
        } else {
            $constructor = $this->prePost;
            $primero = $pre;
            $segundo = $post;
            $metodo = 'preorden y postorden';
            $esPrePost = true;
        }
        $this->validar($primero, $segundo);
        $raiz = $constructor->construir($primero, $segundo);
        if ($raiz === null) {
            throw new ErrorDeEntrada('No fue posible construir el árbol con los recorridos ingresados.');
        }
        $preGenerado = $this->recorridos->preorden($raiz);
        $inGenerado = $this->recorridos->inorden($raiz);
        $postGenerado = $this->recorridos->postorden($raiz);
        if (($usaPre && $preGenerado !== $pre) || ($usaIn && $inGenerado !== $in) || ($usaPost && $postGenerado !== $post)) {
            throw new ErrorDeEntrada('Los recorridos ingresados no corresponden a un mismo árbol binario.');
        }
        $aviso = '';
        if ($esPrePost && $this->hayNodoConUnHijo($raiz)) {
            $aviso = 'Con preorden y postorden el árbol no es único cuando algún nodo tiene un solo hijo. Se muestra uno de los árboles posibles, con ese hijo ubicado a la izquierda.';
        }
        return new ResultadoArbol($raiz, $metodo, $aviso, $preGenerado, $inGenerado, $postGenerado);
    }



    // Revisa tamaño, elementos repetidos y que ambos recorridos tengan los mismos nodos
    private function validar(array $primero, array $segundo): void
    {
        if (count($primero) !== count($segundo)) {
            throw new ErrorDeEntrada('Los recorridos deben tener la misma cantidad de nodos.');
        }
        if (count($primero) > self::MAXIMO_NODOS) {
            throw new ErrorDeEntrada('El árbol admite máximo ' . self::MAXIMO_NODOS . ' nodos.');
        }
        if (count(Arreglos::sinRepetidos($primero)) !== count($primero)) {
            throw new ErrorDeEntrada('Los nodos no pueden repetirse dentro de un recorrido.');
        }
        for ($i = 0; $i < count($primero); $i++) {
            if (!Arreglos::contiene($segundo, $primero[$i])) {
                throw new ErrorDeEntrada('Los recorridos deben contener los mismos nodos.');
            }
        }
    }



    // Indica si algún nodo tiene exactamente un hijo
    private function hayNodoConUnHijo(?NodoArbol $nodo): bool
    {
        if ($nodo === null) {
            return false;
        }
        if (($nodo->izquierdo === null) !== ($nodo->derecho === null)) {
            return true;
        }
        return $this->hayNodoConUnHijo($nodo->izquierdo) || $this->hayNodoConUnHijo($nodo->derecho);
    }
}
