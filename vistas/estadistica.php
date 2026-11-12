<h1>Promedio, mediana y moda</h1>
<p>Primero se indica la cantidad de números y luego se ingresan los valores. Se aclara que el promedio corresponde a la media aritmética, por lo que además se calcula la mediana.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="get" action="estadistica.php">
    <label for="cantidad">Cantidad de números (máximo <?= $this->e($maximo) ?>)</label>
    <input type="number" id="cantidad" name="cantidad" min="1" max="<?= $this->e($maximo) ?>" step="1" value="<?= $cantidad > 0 ? $this->e($cantidad) : '' ?>" required>
    <button type="submit">Generar campos</button>
</form>

<?php if ($cantidad > 0): ?>
    <form method="post" action="estadistica.php">
        <div class="cuadricula">
            <?php for ($i = 0; $i < $cantidad; $i++): ?>
                <div>
                    <label for="n<?= $i ?>">Número <?= $i + 1 ?></label>
                    <input type="number" id="n<?= $i ?>" name="numeros[]" step="any" value="<?= $this->e($valores[$i] ?? '') ?>" required>
                </div>
            <?php endfor; ?>
        </div>
        <button type="submit">Calcular</button>
    </form>
<?php endif; ?>

<?php if (count($resultados) > 0): ?>
    <section class="resultado" aria-live="polite">
        <h2>Resultados</h2>
        <table>
            <thead>
                <tr><th scope="col">Medida</th><th scope="col">Valor</th></tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $fila): ?>
                    <tr>
                        <th scope="row"><?= $this->e($fila['nombre']) ?></th>
                        <td><?= $this->e($fila['valor']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
<?php endif; ?>
