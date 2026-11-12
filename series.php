<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorSeries;
use App\Nucleo\Vista;
use App\Servicios\Series\SerieFactorial;
use App\Servicios\Series\SerieFibonacci;



// Ensambla el controlador con sus dependencias y lo ejecuta
$controlador = new ControladorSeries(new Vista(__DIR__ . '/vistas'), [new SerieFibonacci(), new SerieFactorial()]);
$controlador->ejecutar();
