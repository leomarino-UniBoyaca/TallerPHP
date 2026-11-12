<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Binario\ConversorBinario;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Lector;

//Aplicación de conversión: número entero a binario.
final class BinarioControlador extends ControladorBase
{
    public function __construct(Vista $vista, private Lector $lector, private ConversorBinario $conversor)
    {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', '');
    }

    protected function procesar(Solicitud $solicitud): void
    {
        $numero = $solicitud->dato('numero');

        try {
            $resultado = $this->vista->renderizar('binario/resultado', [
                'binario' => $this->conversor->convertir($this->lector->entero($numero)),
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($numero, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/binario.
    private function dibujar(string $numero, string $resultado): void
    {
        $this->pagina('binario/pagina', ['numero' => $numero, 'resultado' => $resultado], 'Número a binario');
    }
}
