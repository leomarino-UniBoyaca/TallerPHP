<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorAcronimo;
use App\Nucleo\Vista;
use App\Servicios\Acronimo\GeneradorAcronimosEstandar;



// Ensambla el controlador con sus dependencias y lo ejecuta
$controlador = new ControladorAcronimo(new Vista(__DIR__ . '/vistas'), new GeneradorAcronimosEstandar());
$controlador->ejecutar();
