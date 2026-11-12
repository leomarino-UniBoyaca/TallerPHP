<?php

declare(strict_types=1);

namespace App\Nucleo;

use InvalidArgumentException;



// Error por datos incorrectos del usuario; los controladores lo muestran en pantalla
final class ErrorDeEntrada extends InvalidArgumentException
{
}
