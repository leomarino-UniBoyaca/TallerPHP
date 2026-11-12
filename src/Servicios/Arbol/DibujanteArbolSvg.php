<?php

declare(strict_types=1);

namespace App\Servicios\Arbol;



// Dibuja el árbol como imagen SVG en blanco y negro; la posición horizontal sigue el orden inorden
final class DibujanteArbolSvg implements DibujanteArbol
{
    private const MARGEN = 30;
    private const ALTO_NIVEL = 70;



    // Calcula posiciones de los nodos y arma el SVG
    public function dibujar(NodoArbol $raiz): string
    {
        $lista = [];
        $contador = 0;
        $ids = 0;
        $this->recorrer($raiz, 0, null, $contador, $ids, $lista);



        $mayorTexto = 1;
        $ultimoNivel = 0;
        foreach ($lista as $dato) {
            $mayorTexto = max($mayorTexto, mb_strlen($dato['valor']));
            $ultimoNivel = max($ultimoNivel, $dato['nivel']);
        }
        $radio = max(20, intdiv($mayorTexto * 8, 2) + 8);
        $separacion = 2 * $radio + 16;
        $ancho = ($contador - 1) * $separacion + 2 * ($radio + self::MARGEN);
        $alto = $ultimoNivel * self::ALTO_NIVEL + 2 * ($radio + self::MARGEN);



        $lineas = '';
        $nodos = '';
        foreach ($lista as $dato) {
            $x = $radio + self::MARGEN + $dato['x'] * $separacion;
            $y = $radio + self::MARGEN + $dato['nivel'] * self::ALTO_NIVEL;
            if ($dato['padre'] !== null) {
                $padre = $lista[$dato['padre']];
                $xPadre = $radio + self::MARGEN + $padre['x'] * $separacion;
                $yPadre = $radio + self::MARGEN + $padre['nivel'] * self::ALTO_NIVEL;
                $lineas .= '<line x1="' . $xPadre . '" y1="' . $yPadre . '" x2="' . $x . '" y2="' . $y . '" stroke="#000" stroke-width="2"/>';
            }
            $texto = htmlspecialchars($dato['valor'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $nodos .= '<circle cx="' . $x . '" cy="' . $y . '" r="' . $radio . '" fill="#fff" stroke="#000" stroke-width="2"/>';
            $nodos .= '<text x="' . $x . '" y="' . $y . '" text-anchor="middle" dominant-baseline="central" font-family="Arial, sans-serif" font-size="16" fill="#000">' . $texto . '</text>';
        }



        return '<svg xmlns="http://www.w3.org/2000/svg" width="' . $ancho . '" height="' . $alto . '" viewBox="0 0 ' . $ancho . ' ' . $alto . '" role="img" aria-label="Representación gráfica del árbol binario">'
            . $lineas . $nodos . '</svg>';
    }



    // Recorre el árbol en inorden para asignar la columna de cada nodo (apoyo de dibujar)
    private function recorrer(?NodoArbol $nodo, int $nivel, ?int $padre, int &$contador, int &$ids, array &$lista): void
    {
        if ($nodo === null) {
            return;
        }
        $id = $ids;
        $ids++;
        $this->recorrer($nodo->izquierdo, $nivel + 1, $id, $contador, $ids, $lista);
        $lista[$id] = ['valor' => $nodo->valor, 'x' => $contador, 'nivel' => $nivel, 'padre' => $padre];
        $contador++;
        $this->recorrer($nodo->derecho, $nivel + 1, $id, $contador, $ids, $lista);
    }
}
