<?php

declare(strict_types=1);

namespace App\Servicios\Conjuntos;

use App\Utilidades\Arreglos;



// Conjunto de números enteros sin repetidos y ordenado
final class ConjuntoEnteros
{
    private array $elementos;



    // Recibe una lista y elimina los repetidos
    public function __construct(array $valores)
    {
        $this->elementos = Arreglos::ordenar(Arreglos::sinRepetidos($valores));
    }



    public function elementos(): array
    {
        return $this->elementos;
    }



    // Todos los elementos de ambos conjuntos
    public function union(self $otro): self
    {
        $todos = $this->elementos;
        $adicionales = $otro->elementos();
        for ($i = 0; $i < count($adicionales); $i++) {
            $todos[] = $adicionales[$i];
        }
        return new self($todos);
    }



    // Solo los elementos presentes en ambos conjuntos
    public function interseccion(self $otro): self
    {
        $comunes = [];
        for ($i = 0; $i < count($this->elementos); $i++) {
            if (Arreglos::contiene($otro->elementos(), $this->elementos[$i])) {
                $comunes[] = $this->elementos[$i];
            }
        }
        return new self($comunes);
    }



    // Elementos de este conjunto que no están en el otro
    public function diferencia(self $otro): self
    {
        $restantes = [];
        for ($i = 0; $i < count($this->elementos); $i++) {
            if (!Arreglos::contiene($otro->elementos(), $this->elementos[$i])) {
                $restantes[] = $this->elementos[$i];
            }
        }
        return new self($restantes);
    }
}
