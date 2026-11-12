<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Calculadora\Calculadora;
use App\Modelos\Calculadora\HistorialDeOperaciones;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Sesion;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;
use App\Utilidades\Formato;
use App\Utilidades\Lector;

//Aplicación de calculadora: opera dos números y guarda el historial.
final class CalculadoraControlador extends ControladorBase
{
    private const MENSAJE = 'mensaje_calculadora';

    public function __construct(
        Vista $vista,
        private Lector $lector,
        private Calculadora $calculadora,
        private HistorialDeOperaciones $historial,
        private Sesion $sesion
    ) {
        parent::__construct($vista);
    }

    //Muestra el formulario, el último resultado o error (guardado en sesión) y el historial.
    protected function mostrar(Solicitud $solicitud): void
    {
        $mensaje = $this->sesion->extraer(self::MENSAJE, []);
        $mensaje = is_array($mensaje) ? $mensaje : [];
        $operacion = (string) ($mensaje['operacion'] ?? 'suma');

        $bloque = '';

        if (isset($mensaje['error'])) {
            $bloque = $this->aviso((string) $mensaje['error']);
        } elseif (isset($mensaje['resultado'])) {
            $bloque = $this->vista->renderizar('calculadora/resultado', ['resultado' => (string) $mensaje['resultado']]);
        }

        $this->pagina('calculadora/pagina', [
            'a' => (string) ($mensaje['a'] ?? ''),
            'b' => (string) ($mensaje['b'] ?? ''),
            'operaciones' => $this->opciones($operacion),
            'mensaje' => $bloque,
            'historial' => $this->bloqueHistorial(),
        ], 'Calculadora');
    }

    //Atiende los dos botones del módulo (calcular y borrar) y redirige para evitar reenvíos al recargar.
    protected function procesar(Solicitud $solicitud): void
    {
        if ($solicitud->dato('accion') === 'borrar') {
            $this->historial->borrar();
        } else {
            $this->sesion->guardar(self::MENSAJE, $this->calcular($solicitud));
        }

        header('Location: index.php?app=calculadora', true, 303);
    }

    //Realiza la operación y guarda la línea en el historial; devuelve el mensaje para la siguiente visita.
    private function calcular(Solicitud $solicitud): array
    {
        $textoA = $solicitud->dato('a');
        $textoB = $solicitud->dato('b');
        $clave = $solicitud->dato('operacion', 'suma');

        try {
            $a = $this->lector->decimal($textoA);
            $b = $this->lector->decimal($textoB);
            $res = $this->calculadora->calcular($clave, $a, $b);

            $simbolo = $this->calculadora->operacion($clave)->simbolo();
            $linea = Formato::numero($a) . ' ' . $simbolo . ' ' . Formato::numero($b) . ' = ' . Formato::numero($res);
            $this->historial->agregar($linea);

            return ['resultado' => $linea];
        } catch (ExcepcionDeEntrada $e) {
            return ['error' => $e->getMessage(), 'a' => $textoA, 'b' => $textoB, 'operacion' => $clave];
        }
    }

    //Arma las opciones del selector de operaciones marcando la elegida.
    private function opciones(string $operacion): string
    {
        $filas = [];

        foreach ($this->calculadora->nombres() as $clave => $nombre) {
            $filas[] = [
                'valor' => $clave,
                'texto' => $nombre,
                'seleccionada' => $clave === $operacion ? ' selected' : '',
            ];
        }

        return $this->vista->repetir('parciales/opcion', $filas);
    }

    //Arma el historial: la lista con el botón de borrar o el texto de historial vacío.
    private function bloqueHistorial(): string
    {
        $lineas = $this->historial->todas();

        if (count($lineas) === 0) {
            return $this->vista->renderizar('calculadora/historial_vacio');
        }

        $filas = [];

        for ($i = 0; $i < count($lineas); $i++) {
            $filas[] = ['linea' => $lineas[$i]];
        }

        return $this->vista->renderizar('calculadora/historial_lista', [
            'items' => $this->vista->repetir('calculadora/item', $filas),
        ]);
    }
}
