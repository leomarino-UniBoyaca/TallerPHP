<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Calculadora\ServicioCalculadora;
use App\Utilidades\Validador;



// Aplicación 7: calculadora con historial; tras cada acción se redirige para evitar reenvíos del formulario
final class ControladorCalculadora extends ControladorBase
{
    public function __construct(Vista $vista, private ServicioCalculadora $servicio)
    {
        parent::__construct($vista);
    }



    public function ejecutar(): void
    {
        $numeroA = '';
        $numeroB = '';
        $operacion = '';
        $error = '';
        if ($this->esPost()) {
            if ($this->textoPost('accion') === 'borrar') {
                $this->servicio->borrarHistorial();
                $this->redirigir('calculadora.php');
            }
            $numeroA = $this->textoPost('numero_a');
            $numeroB = $this->textoPost('numero_b');
            $operacion = $this->textoPost('operacion');
            try {
                $a = Validador::decimal($numeroA, 'Primer número');
                $b = Validador::decimal($numeroB, 'Segundo número');
                $this->servicio->calcular($operacion, $a, $b);
                $this->redirigir('calculadora.php');
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
            }
        }
        $operaciones = $this->servicio->operaciones();
        $historial = $this->servicio->historial();
        $this->vista->renderizar('calculadora', compact('numeroA', 'numeroB', 'operacion', 'error', 'operaciones', 'historial'), 'Calculadora');
    }
}
