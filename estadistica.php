<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorEstadistica;
use App\Nucleo\Vista;
use App\Servicios\Estadistica\Mediana;
use App\Servicios\Estadistica\Moda;
use App\Servicios\Estadistica\Promedio;



// Ensambla el controlador con sus dependencias y lo ejecuta
$controlador = new ControladorEstadistica(new Vista(__DIR__ . '/vistas'), [new Promedio(), new Mediana(), new Moda()]);
$controlador->ejecutar();
