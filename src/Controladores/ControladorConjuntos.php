<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Servicios\Conjuntos\ConjuntoEnteros;
use App\Utilidades\Formato;
use App\Utilidades\Validador;



// Aplicación 4: unión, intersección y diferencias entre dos conjuntos
final class ControladorConjuntos extends ControladorBase
{
    private const MAXIMO_ELEMENTOS = 200;



    public function ejecutar(): void
    {
        $textoA = '';
        $textoB = '';
        $resultados = [];
        $error = '';
        if ($this->esPost()) {
            $textoA = $this->textoPost('conjunto_a');
            $textoB = $this->textoPost('conjunto_b');
            try {
                $a = new ConjuntoEnteros(Validador::listaEnteros($textoA, 'Conjunto A', self::MAXIMO_ELEMENTOS));
                $b = new ConjuntoEnteros(Validador::listaEnteros($textoB, 'Conjunto B', self::MAXIMO_ELEMENTOS));
                $resultados = [
                    ['etiqueta' => 'Conjunto A', 'valor' => Formato::conjunto($a->elementos())],
                    ['etiqueta' => 'Conjunto B', 'valor' => Formato::conjunto($b->elementos())],
                    ['etiqueta' => 'Unión (A ∪ B)', 'valor' => Formato::conjunto($a->union($b)->elementos())],
                    ['etiqueta' => 'Intersección (A ∩ B)', 'valor' => Formato::conjunto($a->interseccion($b)->elementos())],
                    ['etiqueta' => 'Diferencia (A - B)', 'valor' => Formato::conjunto($a->diferencia($b)->elementos())],
                    ['etiqueta' => 'Diferencia (B - A)', 'valor' => Formato::conjunto($b->diferencia($a)->elementos())],
                ];
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
            }
        }
        $this->vista->renderizar('conjuntos', compact('textoA', 'textoB', 'resultados', 'error'), 'Conjuntos');
    }
}
