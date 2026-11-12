<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Series\GeneradorSerie;
use App\Utilidades\Validador;



// Aplicación 2: genera la serie de Fibonacci o de factoriales
final class ControladorSeries extends ControladorBase
{
    /** @var array<string, GeneradorSerie> */
    private array $generadores = [];



    public function __construct(Vista $vista, array $generadores)
    {
        parent::__construct($vista);
        for ($i = 0; $i < count($generadores); $i++) {
            $this->generadores[$generadores[$i]->clave()] = $generadores[$i];
        }
    }



    public function ejecutar(): void
    {
        $numero = '';
        $operacion = '';
        $serie = [];
        $nombre = '';
        $final = '';
        $error = '';
        if ($this->esPost()) {
            $numero = $this->textoPost('numero');
            $operacion = $this->textoPost('operacion');
            try {
                if (!isset($this->generadores[$operacion])) {
                    throw new ErrorDeEntrada('Debe seleccionarse una operación válida.');
                }
                $generador = $this->generadores[$operacion];
                $n = Validador::entero($numero, 3, 'número');
                if ($n < 0 || $n > $generador->maximo()) {
                    throw new ErrorDeEntrada('Para esta operación el número debe estar entre 0 y ' . $generador->maximo() . '.');
                }
                $serie = $generador->generar($n);
                $nombre = $generador->nombre();
                $final = (string) $serie[count($serie) - 1];
            } catch (ErrorDeEntrada $excepcion) {
                $error = $excepcion->getMessage();
            }
        }
        $opciones = $this->opciones();
        $this->vista->renderizar('series', compact('numero', 'operacion', 'serie', 'nombre', 'final', 'error', 'opciones'), 'Fibonacci y factorial');
    }



    // Prepara las opciones del selector de operación
    private function opciones(): array
    {
        $opciones = [];
        foreach ($this->generadores as $clave => $generador) {
            $opciones[] = ['clave' => $clave, 'nombre' => $generador->nombre(), 'maximo' => $generador->maximo()];
        }
        return $opciones;
    }
}
