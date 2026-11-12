<?php

declare(strict_types=1);

use App\Nucleo\Solicitud;

//Punto de entrada: arma la aplicación y despacha la solicitud.
$enrutador = require __DIR__ . '/../app/arranque.php';

$enrutador->despachar(Solicitud::desdeGlobales());
