<?php

declare(strict_types=1);

namespace App\Nucleo;

//Envuelve $_SESSION; lo usan el historial de la calculadora y los mensajes de un solo uso.
final class Sesion
{
    //Devuelve un valor guardado o el valor por defecto.
    public function obtener(string $clave, mixed $defecto = null): mixed
    {
        return $_SESSION[$clave] ?? $defecto;
    }

    //Guarda un valor.
    public function guardar(string $clave, mixed $valor): void
    {
        $_SESSION[$clave] = $valor;
    }

    //Lee un valor y lo elimina (sirve para mostrar un mensaje una sola vez).
    public function extraer(string $clave, mixed $defecto = null): mixed
    {
        $valor = $_SESSION[$clave] ?? $defecto;
        unset($_SESSION[$clave]);

        return $valor;
    }
}
