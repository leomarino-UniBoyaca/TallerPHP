<?php

declare(strict_types=1);


// Carga automática de las clases del espacio de nombres App desde la carpeta src
spl_autoload_register(function (string $clase): void {
    $prefijo = 'App\\';
    if (strncmp($clase, $prefijo, strlen($prefijo)) !== 0) {
        return;
    }
    $relativa = substr($clase, strlen($prefijo));
    $ruta = __DIR__ . '/' . str_replace('\\', '/', $relativa) . '.php';
    if (is_file($ruta)) {
        require $ruta;
    }
});



// Sesión usada por el historial de la calculadora
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
