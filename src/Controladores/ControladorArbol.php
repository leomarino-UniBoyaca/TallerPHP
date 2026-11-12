<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Arbol\DibujanteArbol;
use App\Servicios\Arbol\ServicioArbol;
use App\Utilidades\Validador;



// Aplicación 6: construye y dibuja un árbol binario a partir de sus recorridos
final class ControladorArbol extends ControladorBase
{
    public function __construct(Vista $vista, private ServicioArbol $servicio, private DibujanteArbol $dibujante)
    {
        parent::__construct($vista);
    }



    public function ejecutar(): void
    {
        $textos = ['preorden' => '', 'inorden' => '', 'postorden' => ''];
        $resultado = null;
        $dibujo = '';
        $error = '';
        if ($this->esPost()) {
            $textos['preorden'] = $this->textoPost('preorden');
            $textos['inorden'] = $this->textoPost('inorden');
            $textos['postorden'] = $this->textoPost('postorden');
            try {
                $resultado = $this->servicio->construir(
                    Validador::elementos($textos['preorden']),
                    Validador::elementos($textos['inorden']),
                    Validador::elementos($textos['postorden'])
                );
                $dibujo = $this->dibujante->dibujar($resultado->raiz);
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
                $resultado = null;
            }
        }
        $this->vista->renderizar('arbol', compact('textos', 'resultado', 'dibujo', 'error'), 'Árbol binario');
    }
}
