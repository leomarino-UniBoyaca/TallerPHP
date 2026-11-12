<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ErrorDeEntrada;
use App\Nucleo\Vista;
use App\Servicios\Estadistica\MedidaEstadistica;
use App\Utilidades\Formato;
use App\Utilidades\Validador;



// Aplicación 3: calcula medidas estadísticas; primero se pide la cantidad y luego los números
final class ControladorEstadistica extends ControladorBase
{
    private const MAXIMO = 50;



    /** @param MedidaEstadistica[] $medidas */
    public function __construct(Vista $vista, private array $medidas)
    {
        parent::__construct($vista);
    }



    public function ejecutar(): void
    {
        $cantidad = 0;
        $valores = [];
        $resultados = [];
        $error = '';
        try {
            if ($this->esPost()) {
                $crudos = $_POST['numeros'] ?? [];
                $crudos = is_array($crudos) ? array_values($crudos) : [];
                for ($i = 0; $i < count($crudos); $i++) {
                    $valores[] = is_string($crudos[$i]) ? trim($crudos[$i]) : '';
                }
                $this->validarCantidad(count($valores));
                $cantidad = count($valores);
                $numeros = [];
                for ($i = 0; $i < $cantidad; $i++) {
                    $numeros[] = Validador::decimal($valores[$i], 'Número ' . ($i + 1));
                }
                $resultados = $this->calcular($numeros);
            } elseif ($this->textoGet('cantidad') !== '') {
                $pedida = Validador::entero($this->textoGet('cantidad'), 3, 'cantidad');
                $this->validarCantidad($pedida);
                $cantidad = $pedida;
                for ($i = 0; $i < $cantidad; $i++) {
                    $valores[] = '';
                }
            }
        } catch (ErrorDeEntrada $excepcion) {
            $error = $excepcion->getMessage();
        }
        $maximo = self::MAXIMO;
        $this->vista->renderizar('estadistica', compact('cantidad', 'valores', 'resultados', 'error', 'maximo'), 'Promedio, mediana y moda');
    }



    // Verifica que la cantidad esté en el rango permitido
    private function validarCantidad(int $cantidad): void
    {
        if ($cantidad < 1 || $cantidad > self::MAXIMO) {
            throw new ErrorDeEntrada('La cantidad de números debe estar entre 1 y ' . self::MAXIMO . '.');
        }
    }



    // Aplica cada medida a los números y da formato al resultado
    private function calcular(array $numeros): array
    {
        $resultados = [];
        for ($i = 0; $i < count($this->medidas); $i++) {
            $medida = $this->medidas[$i];
            $valores = $medida->calcular($numeros);
            $textos = [];
            for ($j = 0; $j < count($valores); $j++) {
                $textos[] = Formato::numero($valores[$j]);
            }
            $resultados[] = [
                'nombre' => $medida->nombre(),
                'valor' => count($textos) > 0 ? implode(', ', $textos) : 'No hay valor que se repita más que los demás',
            ];
        }
        return $resultados;
    }
}
