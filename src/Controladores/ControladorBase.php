<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\Vista;



// Funciones comunes para leer formularios y redirigir
abstract class ControladorBase implements Controlador
{
    public function __construct(protected Vista $vista)
    {
    }



    // Indica si la petición se envió por POST
    protected function esPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }



    // Lee un campo de texto enviado por POST
    protected function textoPost(string $campo): string
    {
        $valor = $_POST[$campo] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }



    // Lee un campo de texto enviado por GET
    protected function textoGet(string $campo): string
    {
        $valor = $_GET[$campo] ?? '';
        return is_string($valor) ? trim($valor) : '';
    }



    // Envía al usuario a otra página y termina la ejecución
    protected function redirigir(string $destino): never
    {
        header('Location: ' . $destino);
        exit;
    }
}
