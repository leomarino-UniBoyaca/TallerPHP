<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorBinario;
use App\Nucleo\Vista;
use App\Servicios\Binario\ConversorBinario;



// Ensambla el controlador con sus dependencias y lo ejecuta
$controlador = new ControladorBinario(new Vista(__DIR__ . '/vistas'), new ConversorBinario());
$controlador->ejecutar();
