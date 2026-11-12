<h1>Operaciones entre conjuntos</h1>
<p>Cada conjunto se escribe con números enteros separados por comas, espacios o punto y coma. Los valores repetidos se cuentan una sola vez.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="conjuntos.php">
    <label for="conjunto_a">Conjunto A</label>
    <input type="text" id="conjunto_a" name="conjunto_a" placeholder="1, 2, 3, 4" value="<?= $this->e($textoA) ?>" required>

    <label for="conjunto_b">Conjunto B</label>
    <input type="text" id="conjunto_b" name="conjunto_b" placeholder="3, 4, 5, 6" value="<?= $this->e($textoB) ?>" required>

    <button type="submit">Calcular</button>
</form>

<?php if (count($resultados) > 0): ?>
    <section class="resultado" aria-live="polite">
        <h2>Resultados</h2>
        <table>
            <thead>
                <tr><th scope="col">Operación</th><th scope="col">Resultado</th></tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $fila): ?>
                    <tr>
                        <th scope="row"><?= $this->e($fila['etiqueta']) ?></th>
                        <td><?= $this->e($fila['valor']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
<?php endif; ?>
