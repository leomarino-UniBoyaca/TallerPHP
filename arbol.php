<?php

declare(strict_types=1);

require __DIR__ . '/src/arranque.php';

use App\Controladores\ControladorArbol;
use App\Nucleo\Vista;
use App\Servicios\Arbol\ConstructorPostIn;
use App\Servicios\Arbol\ConstructorPrePost;
use App\Servicios\Arbol\ConstructorPreIn;
use App\Servicios\Arbol\DibujanteArbolSvg;
use App\Servicios\Arbol\RecorridosArbol;
use App\Servicios\Arbol\ServicioArbol;



// Ensambla el controlador con sus dependencias y lo ejecuta
$servicio = new ServicioArbol(new ConstructorPreIn(), new ConstructorPostIn(), new ConstructorPrePost(), new RecorridosArbol());
$controlador = new ControladorArbol(new Vista(__DIR__ . '/vistas'), $servicio, new DibujanteArbolSvg());
$controlador->ejecutar();
