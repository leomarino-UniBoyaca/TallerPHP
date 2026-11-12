<h1>Sucesión de Fibonacci y factorial</h1>
<p>Se ingresa un número n y se selecciona la operación. El resultado muestra la serie desde la posición 0 hasta n.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="series.php">
    <label for="numero">Número (n)</label>
    <input type="number" id="numero" name="numero" min="0" max="90" step="1" value="<?= $this->e($numero) ?>" required>

    <label for="operacion">Operación</label>
    <select id="operacion" name="operacion" required>
        <?php foreach ($opciones as $opcion): ?>
            <option value="<?= $this->e($opcion['clave']) ?>" <?= $operacion === $opcion['clave'] ? 'selected' : '' ?>>
                <?= $this->e($opcion['nombre']) ?> (n máximo: <?= $this->e($opcion['maximo']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Calcular</button>
</form>

<?php if (count($serie) > 0): ?>
    <section class="resultado" aria-live="polite">
        <h2><?= $this->e($nombre) ?></h2>
        <p>Serie generada:</p>
        <p class="destacado"><?= $this->e(implode(', ', $serie)) ?></p>
        <p>Valor en la posición n: <strong><?= $this->e($final) ?></strong></p>
    </section>
<?php endif; ?>
