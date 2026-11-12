<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Binario\Conversor;
use App\Utilidades\Validador;



// Aplicación 5: convierte un entero a binario
final class ControladorBinario extends ControladorBase
{
    public function __construct(Vista $vista, private Conversor $conversor)
    {
        parent::__construct($vista);
    }



    public function ejecutar(): void
    {
        $numero = '';
        $binario = '';
        $error = '';
        if ($this->esPost()) {
            $numero = $this->textoPost('numero');
            try {
                $entero = Validador::entero($numero, 18, 'número');
                $binario = $this->conversor->convertir($entero);
                $numero = (string) $entero;
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
            }
        }
        $this->vista->renderizar('binario', compact('numero', 'binario', 'error'), 'Número binario');
    }
}
