<?php

declare(strict_types=1);

namespace App\Modelos\Calculadora;

//Contrato del historial; el controlador depende de esto y no del lugar donde se guarda.
interface HistorialDeOperaciones
{
    public function agregar(string $linea): void;

    //Devuelve las líneas guardadas, la más reciente primero.
    public function todas(): array;

    public function borrar(): void;
}
