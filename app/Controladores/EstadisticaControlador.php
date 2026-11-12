<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Estadistica\EstadisticaDescriptiva;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Formato;
use App\Utilidades\Lector;

//Aplicación de estadística: promedio, mediana y moda de los números ingresados.
final class EstadisticaControlador extends ControladorBase
{
    public function __construct(Vista $vista, private Lector $lector)
    {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', '');
    }

    //Lee los números, calcula las medidas y las deja como texto listo para mostrar.
    protected function procesar(Solicitud $solicitud): void
    {
        $valores = $solicitud->dato('valores');

        try {
            $estadistica = new EstadisticaDescriptiva($this->lector->reales($valores));
            $moda = $estadistica->moda();
            $textosModa = [];

            for ($i = 0; $i < count($moda); $i++) {
                $textosModa[] = Formato::numero($moda[$i]);
            }

            $resultado = $this->vista->renderizar('estadistica/resultado', [
                'promedio' => Formato::numero($estadistica->promedio()),
                'mediana' => Formato::numero($estadistica->mediana()),
                'moda' => count($textosModa) > 0 ? implode(', ', $textosModa) : 'No hay un valor que se repita más que los demás',
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($valores, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/estadistica.
    private function dibujar(string $valores, string $resultado): void
    {
        $this->pagina('estadistica/pagina', ['valores' => $valores, 'resultado' => $resultado], 'Promedio, mediana y moda');
    }
}
