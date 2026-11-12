<h1>Calculadora</h1>
<p>Se ingresan dos números enteros o decimales y se selecciona la operación. El porcentaje calcula el primer número como porcentaje del segundo (por ejemplo, 15 % de 200 es 30).</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="calculadora.php">
    <input type="hidden" name="accion" value="calcular">

    <label for="numero_a">Primer número</label>
    <input type="number" id="numero_a" name="numero_a" step="any" value="<?= $this->e($numeroA) ?>" required>

    <label for="operacion">Operación</label>
    <select id="operacion" name="operacion" required>
        <?php foreach ($operaciones as $opcion): ?>
            <option value="<?= $this->e($opcion->clave()) ?>" <?= $operacion === $opcion->clave() ? 'selected' : '' ?>>
                <?= $this->e($opcion->nombre()) ?> (<?= $this->e($opcion->simbolo()) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label for="numero_b">Segundo número</label>
    <input type="number" id="numero_b" name="numero_b" step="any" value="<?= $this->e($numeroB) ?>" required>

    <button type="submit">Calcular</button>
</form>

<section class="resultado" aria-live="polite">
    <h2>Historial</h2>
    <?php if (count($historial) === 0): ?>
        <p>Aún no hay operaciones registradas.</p>
    <?php else: ?>
        <p>Último resultado: <strong class="destacado"><?= $this->e($historial[0]) ?></strong></p>
        <ol class="historial">
            <?php foreach ($historial as $registro): ?>
                <li><?= $this->e($registro) ?></li>
            <?php endforeach; ?>
        </ol>
        <form method="post" action="calculadora.php">
            <input type="hidden" name="accion" value="borrar">
            <button type="submit">Borrar historial</button>
        </form>
    <?php endif; ?>
</section>
