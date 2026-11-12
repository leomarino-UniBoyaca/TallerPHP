<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Conjuntos\OperacionesDeConjuntos;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Formato;
use App\Utilidades\Lector;

//Aplicación de conjuntos: unión, intersección y diferencias entre A y B.
final class ConjuntosControlador extends ControladorBase
{
    public function __construct(
        Vista $vista,
        private Lector $lector,
        private OperacionesDeConjuntos $operaciones
    ) {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', '', '');
    }

    //Lee ambos conjuntos, aplica las cuatro operaciones y las deja como texto.
    protected function procesar(Solicitud $solicitud): void
    {
        $textoA = $solicitud->dato('conjunto_a');
        $textoB = $solicitud->dato('conjunto_b');

        try {
            $a = $this->operaciones->normalizar($this->lector->enteros($textoA));
            $b = $this->operaciones->normalizar($this->lector->enteros($textoB));

            $resultado = $this->vista->renderizar('conjuntos/resultado', [
                'a' => Formato::conjunto($a),
                'b' => Formato::conjunto($b),
                'union' => Formato::conjunto($this->operaciones->union($a, $b)),
                'interseccion' => Formato::conjunto($this->operaciones->interseccion($a, $b)),
                'a_menos_b' => Formato::conjunto($this->operaciones->diferencia($a, $b)),
                'b_menos_a' => Formato::conjunto($this->operaciones->diferencia($b, $a)),
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($textoA, $textoB, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/conjuntos.
    private function dibujar(string $textoA, string $textoB, string $resultado): void
    {
        $this->pagina('conjuntos/pagina', [
            'textoA' => $textoA,
            'textoB' => $textoB,
            'resultado' => $resultado,
        ], 'Conjuntos');
    }
}
