<?php

declare(strict_types=1);

use App\Controladores\AcronimoControlador;
use App\Controladores\ArbolControlador;
use App\Controladores\BinarioControlador;
use App\Controladores\CalculadoraControlador;
use App\Controladores\ConjuntosControlador;
use App\Controladores\EstadisticaControlador;
use App\Controladores\InicioControlador;
use App\Controladores\SeriesControlador;
use App\Modelos\Acronimo\GeneradorDeAcronimos;
use App\Modelos\Arbol\ConstructorDeArbol;
use App\Modelos\Arbol\InordenPostorden;
use App\Modelos\Arbol\PreordenInorden;
use App\Modelos\Arbol\PreordenPostorden;
use App\Modelos\Binario\ConversorBinario;
use App\Modelos\Calculadora\Calculadora;
use App\Modelos\Calculadora\Division;
use App\Modelos\Calculadora\HistorialEnSesion;
use App\Modelos\Calculadora\Multiplicacion;
use App\Modelos\Calculadora\Porcentaje;
use App\Modelos\Calculadora\Resta;
use App\Modelos\Calculadora\Suma;
use App\Modelos\Conjuntos\OperacionesDeConjuntos;
use App\Modelos\Series\Factorial;
use App\Modelos\Series\Fibonacci;
use App\Nucleo\Enrutador;
use App\Nucleo\Sesion;
use App\Nucleo\Vista;
use App\Utilidades\Lector;

//Autocarga de clases: App\Carpeta\Clase se busca en app/Carpeta/Clase.php.
spl_autoload_register(function (string $clase): void {
    $prefijo = 'App\\';

    if (strncmp($clase, $prefijo, strlen($prefijo)) !== 0) {
        return;
    }

    $ruta = __DIR__ . '/' . str_replace('\\', '/', substr($clase, strlen($prefijo))) . '.php';

    if (is_file($ruta)) {
        require $ruta;
    }
});

//La sesión guarda el historial de la calculadora.
session_start();

//Objetos compartidos por los controladores.
$vista = new Vista(__DIR__ . '/Vistas');
$sesion = new Sesion();
$lector = new Lector();

//Menú: clave de la aplicación y texto del botón (el orden es el que se ve en pantalla).
$menu = [
    'acronimo' => 'Acrónimo',
    'series' => 'Fibonacci y factorial',
    'estadistica' => 'Promedio, mediana y moda',
    'conjuntos' => 'Conjuntos',
    'binario' => 'Número a binario',
    'arbol' => 'Árbol binario',
    'calculadora' => 'Calculadora',
];

//Registro de rutas: cada aplicación recibe sus dependencias aquí (para agregar una aplicación basta con registrarla).
$enrutador = new Enrutador($vista);

$enrutador->registrar('inicio', new InicioControlador($vista, $menu));

$enrutador->registrar('acronimo', new AcronimoControlador($vista, new GeneradorDeAcronimos()));

$enrutador->registrar('series', new SeriesControlador($vista, $lector, [
    'fibonacci' => new Fibonacci(),
    'factorial' => new Factorial(),
]));

$enrutador->registrar('estadistica', new EstadisticaControlador($vista, $lector));

$enrutador->registrar('conjuntos', new ConjuntosControlador($vista, $lector, new OperacionesDeConjuntos()));

$enrutador->registrar('binario', new BinarioControlador($vista, $lector, new ConversorBinario()));

$enrutador->registrar('arbol', new ArbolControlador(
    $vista,
    $lector,
    new ConstructorDeArbol(new PreordenInorden(), new PreordenPostorden(), new InordenPostorden())
));

$enrutador->registrar('calculadora', new CalculadoraControlador(
    $vista,
    $lector,
    new Calculadora([
        'suma' => new Suma(),
        'resta' => new Resta(),
        'multiplicacion' => new Multiplicacion(),
        'division' => new Division(),
        'porcentaje' => new Porcentaje(),
    ]),
    new HistorialEnSesion($sesion),
    $sesion
));

return $enrutador;
