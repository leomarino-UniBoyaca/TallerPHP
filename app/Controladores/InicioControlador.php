<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;

//Página principal: muestra el menú con un botón por cada aplicación registrada.
final class InicioControlador extends ControladorBase
{
    //El menú trae la clave de cada aplicación y el texto de su botón.
    public function __construct(Vista $vista, private array $menu)
    {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $filas = [];

        foreach ($this->menu as $clave => $texto) {
            $filas[] = ['enlace' => $this->vista->url($clave), 'texto' => $texto];
        }

        $botones = $this->vista->repetir('parciales/boton_menu', $filas);

        $this->vista->mostrar('inicio', ['botones' => $botones], 'Menú principal', 'hoja-marco');
    }
}
