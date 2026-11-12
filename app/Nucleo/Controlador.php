<?php

declare(strict_types=1);

namespace App\Nucleo;

//Contrato común de los controladores: el enrutador solo necesita saber que pueden atender una solicitud.
interface Controlador
{
    public function atender(Solicitud $solicitud): void;
}
