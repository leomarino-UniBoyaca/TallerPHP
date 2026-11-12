<?php

declare(strict_types=1);

namespace App\Controladores;

use App\Modelos\Acronimo\GeneradorDeAcronimos;
use App\Nucleo\ControladorBase;
use App\Nucleo\ExcepcionDeEntrada;
use App\Nucleo\Solicitud;
use App\Nucleo\Vista;

//Aplicación de acrónimos: recibe la frase y muestra las iniciales.
final class AcronimoControlador extends ControladorBase
{
    public function __construct(Vista $vista, private GeneradorDeAcronimos $generador)
    {
        parent::__construct($vista);
    }

    protected function mostrar(Solicitud $solicitud): void
    {
        $this->dibujar('', '');
    }

    //Convierte la frase enviada; si hay un error lo muestra en un aviso.
    protected function procesar(Solicitud $solicitud): void
    {
        $frase = $solicitud->dato('frase');

        try {
            $resultado = $this->vista->renderizar('acronimo/resultado', [
                'acronimo' => $this->generador->generar($frase),
            ]);
        } catch (ExcepcionDeEntrada $e) {
            $resultado = $this->aviso($e->getMessage());
        }

        $this->dibujar($frase, $resultado);
    }

    //Arma la página con las plantillas de app/Vistas/acronimo.
    private function dibujar(string $frase, string $resultado): void
    {
        $this->pagina('acronimo/pagina', ['frase' => $frase, 'resultado' => $resultado], 'Acrónimo');
    }
}
