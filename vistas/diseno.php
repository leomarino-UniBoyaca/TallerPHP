<?php

use App\Nucleo\Aplicaciones;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($titulo) ?> | Taller de PHP</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="cabecera">
        <a class="marca" href="index.php">Taller de PHP</a>
        <nav aria-label="Menú principal">
            <ul class="menu">
                <li><a href="index.php">Inicio</a></li>
                <?php foreach (Aplicaciones::listar() as $aplicacion): ?>
                    <li><a href="<?= $this->e($aplicacion['archivo']) ?>"><?= $this->e($aplicacion['titulo']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
    <main class="contenido">
        <?= $contenido ?>
    </main>
    <footer class="pie">
        <p>Taller de PHP con programación orientada a objetos y principios SOLID.</p>
    </footer>
</body>
</html>
