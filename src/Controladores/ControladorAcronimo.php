<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Acronimo\GeneradorAcronimos;



// Aplicación 1: convierte una frase en su acrónimo
final class ControladorAcronimo extends ControladorBase
{
    public function __construct(Vista $vista, private GeneradorAcronimos $generador)
    {
        parent::__construct($vista);
    }



    public function ejecutar(): void
    {
        $frase = '';
        $acronimo = '';
        $error = '';
        if ($this->esPost()) {
            $frase = $this->textoPost('frase');
            try {
                $acronimo = $this->generador->generar($frase);
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
            }
        }
        $this->vista->renderizar('acronimo', compact('frase', 'acronimo', 'error'), 'Acrónimo');
    }
}
