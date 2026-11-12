<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorConjuntos;
use App\Nucleo\Vista;



// Ensambla el controlador con sus dependencias y lo ejecuta
$controlador = new ControladorConjuntos(new Vista(__DIR__ . '/vistas'));
$controlador->ejecutar();
