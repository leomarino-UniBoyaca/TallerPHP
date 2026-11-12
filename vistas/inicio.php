<h1>Aplicaciones del taller</h1>
<p>Se debe seleccionar una de las siguientes aplicaciones para utilizarla.</p>
<nav aria-label="Aplicaciones disponibles">
    <ul class="tarjetas">
        <?php foreach ($aplicaciones as $indice => $aplicacion): ?>
            <li>
                <a href="<?= $this->e($aplicacion['archivo']) ?>">
                    <span class="numero"><?= $indice + 1 ?></span>
                    <strong><?= $this->e($aplicacion['titulo']) ?></strong>
                    <span><?= $this->e($aplicacion['detalle']) ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
