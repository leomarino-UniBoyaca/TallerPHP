<h1>Convertir un entero a binario</h1>
<p>Se ingresa un número entero de hasta 18 dígitos. Los números negativos se muestran con signo menos seguido del binario de su valor absoluto.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="binario.php">
    <label for="numero">Número entero</label>
    <input type="text" id="numero" name="numero" inputmode="numeric" maxlength="19" value="<?= $this->e($numero) ?>" required>
    <button type="submit">Convertir</button>
</form>

<?php if ($binario !== ''): ?>
    <section class="resultado" aria-live="polite">
        <h2>Resultado</h2>
        <p>El número <?= $this->e($numero) ?> en binario es:</p>
        <p class="destacado texto-largo"><?= $this->e($binario) ?></p>
    </section>
<?php endif; ?>
