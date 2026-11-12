<?php

declare(strict_types=1);

namespace App\Nucleo;

//Guarda los datos de la petición HTTP (GET, POST y método) para que los controladores no lean variables globales.
final class Solicitud
{
    public function __construct(
        private array $consulta,
        private array $datos,
        private string $metodo
    ) {
    }

    //Crea la solicitud a partir de las variables globales de PHP (se usa en public/index.php).
    public static function desdeGlobales(): self
    {
        return new self($_GET, $_POST, $_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    //Indica si el formulario fue enviado.
    public function esPost(): bool
    {
        return $this->metodo === 'POST';
    }

    //Lee un valor de la URL (GET); si no es texto devuelve el valor por defecto.
    public function consulta(string $clave, string $defecto = ''): string
    {
        $valor = $this->consulta[$clave] ?? $defecto;

        return is_string($valor) ? $valor : $defecto;
    }

    //Lee un valor del formulario (POST); si no es texto devuelve el valor por defecto.
    public function dato(string $clave, string $defecto = ''): string
    {
        $valor = $this->datos[$clave] ?? $defecto;

        return is_string($valor) ? $valor : $defecto;
    }
}
