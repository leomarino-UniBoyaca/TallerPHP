<?php

declare(strict_types=1);

namespace App\Nucleo;

//Base de los controladores: separa el caso mostrar el formulario del caso procesar el envío.
abstract class ControladorBase implements Controlador
{
    public function __construct(protected Vista $vista)
    {
    }

    //Lo llama el Enrutador; según el método HTTP delega en mostrar() o procesar().
    public function atender(Solicitud $solicitud): void
    {
        if ($solicitud->esPost()) {
            $this->procesar($solicitud);
            return;
        }

        $this->mostrar($solicitud);
    }

    //Cada controlador define cómo se muestra su pantalla inicial.
    abstract protected function mostrar(Solicitud $solicitud): void;

    //Por defecto un envío se trata como una visita normal (el menú no recibe formularios).
    protected function procesar(Solicitud $solicitud): void
    {
        $this->mostrar($solicitud);
    }

    //Dibuja una página de aplicación agregándole el encabezado con el botón del menú.
    protected function pagina(string $plantilla, array $datos, string $titulo): void
    {
        $datos['encabezado'] = $this->vista->renderizar('parciales/encabezado', ['titulo' => $titulo]);

        $this->vista->mostrar($plantilla, $datos, $titulo);
    }

    //Devuelve el cuadro HTML con un mensaje de error.
    protected function aviso(string $mensaje): string
    {
        return $this->vista->renderizar('parciales/aviso', ['mensaje' => $mensaje]);
    }
}
