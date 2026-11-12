<?php

declare(strict_types=1);

namespace App\Modelos\Series;

//Contrato de las series numéricas; permite agregar otra serie sin cambiar el controlador.
interface GeneradorDeSerie
{
    //Nombre que se muestra en el selector del formulario.
    public function nombre(): string;

    //Texto con el que se escribe el último término (por ejemplo "F(10)" o "10!").
    public function notacion(int $n): string;

    //Devuelve la serie desde el término 0 hasta el término n, cada término como texto.
    public function generar(int $n): array;
}
