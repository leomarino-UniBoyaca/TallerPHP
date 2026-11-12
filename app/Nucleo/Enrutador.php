<?php

declare(strict_types=1);

namespace App\Nucleo;

//Elige el controlador según el parámetro "app" de la URL y le entrega la solicitud.
final class Enrutador
{
    //Controladores registrados, indexados por el nombre de la aplicación.
    private array $controladores = [];

    public function __construct(private Vista $vista)
    {
    }

    //Asocia un nombre de aplicación con su controlador (se llama desde app/arranque.php).
    public function registrar(string $nombre, Controlador $controlador): void
    {
        $this->controladores[$nombre] = $controlador;
    }

    //Atiende la solicitud; si la aplicación no existe responde 404.
    public function despachar(Solicitud $solicitud): void
    {
        $nombre = $solicitud->consulta('app', 'inicio');

        if (!isset($this->controladores[$nombre])) {
            http_response_code(404);
            $this->vista->mostrar('no_encontrada', [], 'Página no encontrada');
            return;
        }

        $this->controladores[$nombre]->atender($solicitud);
    }
}
