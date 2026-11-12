<?php

declare(strict_types=1);

namespace App\Nucleo;



// Catálogo de aplicaciones; lo usan el menú principal y la barra de navegación
final class Aplicaciones
{
    public static function listar(): array
    {
        return [
            ['archivo' => 'acronimo.php', 'titulo' => 'Acrónimo', 'detalle' => 'Convierte una frase en sus siglas.'],
            ['archivo' => 'series.php', 'titulo' => 'Fibonacci y factorial', 'detalle' => 'Genera la serie de Fibonacci o de factoriales hasta un número dado.'],
            ['archivo' => 'estadistica.php', 'titulo' => 'Promedio, mediana y moda', 'detalle' => 'Calcula medidas estadísticas de una serie de números reales.'],
            ['archivo' => 'conjuntos.php', 'titulo' => 'Conjuntos', 'detalle' => 'Calcula unión, intersección y diferencias entre dos conjuntos de enteros.'],
            ['archivo' => 'binario.php', 'titulo' => 'Número binario', 'detalle' => 'Convierte un número entero a su representación binaria.'],
            ['archivo' => 'arbol.php', 'titulo' => 'Árbol binario', 'detalle' => 'Construye un árbol a partir de dos o tres recorridos.'],
            ['archivo' => 'calculadora.php', 'titulo' => 'Calculadora', 'detalle' => 'Realiza operaciones básicas y guarda un historial.'],
        ];
    }
}
