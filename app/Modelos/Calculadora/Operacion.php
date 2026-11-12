<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Contrato de las operaciones; para agregar una nueva solo se crea otra clase y se registra en app/arranque.php.
interface Operacion
{
    //Nombre que se muestra en el selector.
    public function nombre(): string;

    //Símbolo que se escribe en el historial.
    public function simbolo(): string;

    public function calcular(float $a, float $b): float;
}
