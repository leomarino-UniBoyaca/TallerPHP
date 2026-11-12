<?php

declare(strict_types=1);

namespace App\Servicios\Estadistica;

use App\Utilidades\Arreglos;
use App\Utilidades\Formato;



// Valor o valores que más se repiten; devuelve lista vacía si ninguno se repite más que otro
final class Moda implements MedidaEstadistica
{
    public function nombre(): string
    {
        return 'Moda';
    }



    // Cuenta repeticiones por valor y selecciona las mayores
    public function calcular(array $numeros): array
    {
        $resultado = [];
        $conteos = [];
        $mayor = 0;
        for ($i = 0; $i < count($numeros); $i++) {
            $clave = Formato::numero($numeros[$i]);
            $conteos[$clave] = ($conteos[$clave] ?? 0) + 1;
            if ($conteos[$clave] > $mayor) {
                $mayor = $conteos[$clave];
            }
        }
        if ($mayor === 1 && count($conteos) > 1) {
            return $resultado;
        }
        foreach ($conteos as $clave => $veces) {
            if ($veces === $mayor) {
                $resultado[] = (float) $clave;
            }
        }
        return Arreglos::ordenar($resultado);
    }
}
