<h1>Convertir una frase en acrónimo</h1>
<p>Se toma la primera letra de cada palabra. Los guiones separan palabras igual que los espacios y los demás signos de puntuación se eliminan.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="acronimo.php">
    <label for="frase">Frase</label>
    <input type="text" id="frase" name="frase" maxlength="200" value="<?= $this->e($frase) ?>" required>
    <button type="submit">Convertir</button>
</form>

<?php if ($acronimo !== ''): ?>
    <section class="resultado" aria-live="polite">
        <h2>Resultado</h2>
        <p class="destacado"><?= $this->e($acronimo) ?></p>
    </section>
<?php endif; ?>
