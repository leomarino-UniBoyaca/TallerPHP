<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Lector;

//Aplicación de Fibonacci y factorial: genera la serie hasta el número indicado.
final class SeriesControlador extends ControladorBase
{
    private const LIMITE = 100;

    //Los generadores se indexan por la clave de la operación (fibonacci, factorial).
    public function __construct(Vista $vista, private Lector $lector, private array $generadores)
    {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', 'fibonacci', '');
    }

    //Valida el número y la operación, genera la serie y arma el resultado.
    protected function procesar(Solicitud $solicitud): void
    {
        $numero = $solicitud->dato('numero');
        $operacion = $solicitud->dato('operacion', 'fibonacci');

        try {
            if (!isset($this->generadores[$operacion])) {
                throw new ExcepcionDeEntrada('La operación seleccionada no es válida.');
            }

            $n = $this->lector->entero($numero);

            if ($n < 0 || $n > self::LIMITE) {
                throw new ExcepcionDeEntrada('El número debe estar entre 0 y ' . self::LIMITE . '.');
            }

            $generador = $this->generadores[$operacion];
            $serie = $generador->generar($n);

            $resultado = $this->vista->renderizar('series/resultado', [
                'nombre' => $generador->nombre(),
                'ultimo' => count($serie) - 1,
                'serie' => implode(', ', $serie),
                'notacion' => $generador->notacion($n),
                'valor' => $serie[count($serie) - 1],
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($numero, $operacion, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/series.
    private function dibujar(string $numero, string $operacion, string $resultado): void
    {
        $filas = [];

        foreach ($this->generadores as $clave => $generador) {
            $filas[] = [
                'valor' => $clave,
                'texto' => $generador->nombre(),
                'seleccionada' => $clave === $operacion ? ' selected' : '',
            ];
        }

        $this->pagina('series/pagina', [
            'numero' => $numero,
            'limite' => self::LIMITE,
            'opciones' => $this->vista->repetir('parciales/opcion', $filas),
            'resultado' => $resultado,
        ], 'Fibonacci y factorial');
    }
}
