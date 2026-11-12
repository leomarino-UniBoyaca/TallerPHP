<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Arbol\ConstructorDeArbol;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Lector;

//Aplicación de árbol binario: construye el árbol con dos o tres recorridos y muestra sus recorridos.
final class ArbolControlador extends ControladorBase
{
    public function __construct(
        Vista $vista,
        private Lector $lector,
        private ConstructorDeArbol $constructor
    ) {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', '', '', '');
    }

    //Lee los recorridos, construye el árbol y arma el resultado.
    protected function procesar(Solicitud $solicitud): void
    {
        $pre = $solicitud->dato('preorden');
        $ino = $solicitud->dato('inorden');
        $post = $solicitud->dato('postorden');

        try {
            $construido = $this->constructor->construir(
                $this->lector->etiquetas($pre),
                $this->lector->etiquetas($ino),
                $this->lector->etiquetas($post)
            );

            $resultado = $this->vista->renderizar('arbol/resultado', [
                'usados' => $construido->usados,
                'nota' => $construido->ambiguo ? $this->vista->renderizar('arbol/nota_ambiguo') : '',
                'preorden' => implode(' ', $construido->arbol->preorden()),
                'inorden' => implode(' ', $construido->arbol->inorden()),
                'postorden' => implode(' ', $construido->arbol->postorden()),
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($pre, $ino, $post, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/arbol.
    private function dibujar(string $pre, string $ino, string $post, string $resultado): void
    {
        $this->pagina('arbol/pagina', [
            'preorden' => $pre,
            'inorden' => $ino,
            'postorden' => $post,
            'resultado' => $resultado,
        ], 'Árbol binario');
    }
}
