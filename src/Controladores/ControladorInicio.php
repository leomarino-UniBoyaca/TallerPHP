<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\Aplicaciones;



// Página principal con el menú hacia las aplicaciones
final class ControladorInicio extends ControladorBase
{
    public function ejecutar(): void
    {
        $this->vista->renderizar('inicio', ['aplicaciones' => Aplicaciones::listar()], 'Inicio');
    }
}
