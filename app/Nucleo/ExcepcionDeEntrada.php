<?php

declare(strict_types=1);

namespace App\Nucleo;

use InvalidArgumentException;

//Error por datos mal escritos; el mensaje se muestra tal cual en pantalla (lo capturan los controladores).
final class ExcepcionDeEntrada extends InvalidArgumentException
{
}
