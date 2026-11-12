<?php

declare(strict_types=1);

namespace App\Nucleo;

use RuntimeException;

//Lee las plantillas HTML de app/Vistas y reemplaza sus marcadores con datos.
//{{clave}} inserta el dato escapado y {{{clave}}} inserta HTML ya armado.
final class Vista
{
    public function __construct(private string $carpeta)
    {
    }

    //Dibuja una página completa: la plantilla de contenido dentro del diseño general.
    public function mostrar(string $plantilla, array $datos, string $titulo, string $hoja = 'hoja-carta'): void
    {
        $contenido = $this->renderizar($plantilla, $datos);

        echo $this->renderizar('diseno', [
            'contenido' => $contenido,
            'titulo' => $titulo,
            'hoja' => $hoja,
        ]);
    }

    //Lee una plantilla y devuelve su HTML con los marcadores reemplazados.
    public function renderizar(string $plantilla, array $datos = []): string
    {
        $ruta = $this->carpeta . '/' . $plantilla . '.html';

        if (!is_file($ruta)) {
            throw new RuntimeException('No existe la plantilla ' . $plantilla . '.');
        }

        $texto = (string) file_get_contents($ruta);

        return (string) preg_replace_callback(
            '/\{\{\{(\w+)\}\}\}|\{\{(\w+)\}\}/',
            function (array $coincidencia) use ($datos): string {
                if (($coincidencia[1] ?? '') !== '') {
                    return (string) ($datos[$coincidencia[1]] ?? '');
                }

                return $this->escapar($datos[$coincidencia[2]] ?? '');
            },
            $texto
        );
    }

    //Repite una plantilla una vez por cada fila de datos y une los resultados.
    public function repetir(string $plantilla, array $filas): string
    {
        $res = '';

        for ($i = 0; $i < count($filas); $i++) {
            $res .= $this->renderizar($plantilla, $filas[$i]);
        }

        return $res;
    }

    //Construye el enlace hacia una aplicación (lo interpreta el Enrutador).
    public function url(string $aplicacion): string
    {
        return 'index.php?app=' . rawurlencode($aplicacion);
    }

    //Escapa texto para HTML; se aplica a todo dato escrito por el usuario.
    private function escapar(mixed $texto): string
    {
        return htmlspecialchars((string) $texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
