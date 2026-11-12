<?php

declare(strict_types=1);

namespace App\Nucleo;



// Renderiza las plantillas de la carpeta vistas dentro del diseño general
final class Vista
{
    public function __construct(private string $carpeta)
    {
    }



    // Genera la plantilla pedida, la inserta en el diseño y la imprime
    public function renderizar(string $plantilla, array $datos, string $titulo): void
    {
        $contenido = $this->capturar($plantilla, $datos);
        echo $this->capturar('diseno', ['contenido' => $contenido, 'titulo' => $titulo]);
    }



    // Escapa un valor para imprimirlo de forma segura en HTML (se usa dentro de las plantillas)
    public function e(mixed $valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }



    // Ejecuta una plantilla con sus datos y devuelve el HTML como texto
    private function capturar(string $plantilla, array $datos): string
    {
        extract($datos, EXTR_SKIP);
        ob_start();
        require $this->carpeta . '/' . $plantilla . '.php';
        return (string) ob_get_clean();
    }
}
