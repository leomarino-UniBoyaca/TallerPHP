<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorCalculadora;
use App\Nucleo\Vista;
use App\Servicios\Calculadora\Division;
use App\Servicios\Calculadora\HistorialSesion;
use App\Servicios\Calculadora\Multiplicacion;
use App\Servicios\Calculadora\Porcentaje;
use App\Servicios\Calculadora\Resta;
use App\Servicios\Calculadora\ServicioCalculadora;
use App\Servicios\Calculadora\Suma;



// Ensambla el controlador con sus dependencias y lo ejecuta
$servicio = new ServicioCalculadora(
    [new Suma(), new Resta(), new Multiplicacion(), new Division(), new Porcentaje()],
    new HistorialSesion()
);
$controlador = new ControladorCalculadora(new Vista(__DIR__ . '/vistas'), $servicio);
$controlador->ejecutar();
