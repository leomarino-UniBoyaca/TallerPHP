<h1>Árbol binario a partir de sus recorridos</h1>
<p>Se deben ingresar como mínimo dos recorridos. Los nodos se separan con espacios, comas, punto y coma o flechas (por ejemplo, A B D E C). Si se ingresan los tres, se utilizan preorden e inorden.</p>

<?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= $this->e($error) ?></p>
<?php endif; ?>

<form method="post" action="arbol.php">
    <label for="preorden">Preorden</label>
    <input type="text" id="preorden" name="preorden" placeholder="A B D E C" value="<?= $this->e($textos['preorden']) ?>">

    <label for="inorden">Inorden</label>
    <input type="text" id="inorden" name="inorden" placeholder="D B E A C" value="<?= $this->e($textos['inorden']) ?>">

    <label for="postorden">Postorden</label>
    <input type="text" id="postorden" name="postorden" placeholder="D E B C A" value="<?= $this->e($textos['postorden']) ?>">

    <button type="submit">Construir árbol</button>
</form>

<?php if ($resultado !== null): ?>
    <section class="resultado" aria-live="polite">
        <h2>Árbol construido</h2>
        <p>Recorridos utilizados: <?= $this->e($resultado->metodo) ?>.</p>
        <?php if ($resultado->aviso !== ''): ?>
            <p class="aviso"><?= $this->e($resultado->aviso) ?></p>
        <?php endif; ?>
        <div class="lienzo">
            <?= $dibujo ?>
        </div>
        <table>
            <thead>
                <tr><th scope="col">Recorrido</th><th scope="col">Nodos</th></tr>
            </thead>
            <tbody>
                <tr><th scope="row">Preorden</th><td><?= $this->e(implode(' → ', $resultado->preorden)) ?></td></tr>
                <tr><th scope="row">Inorden</th><td><?= $this->e(implode(' → ', $resultado->inorden)) ?></td></tr>
                <tr><th scope="row">Postorden</th><td><?= $this->e(implode(' → ', $resultado->postorden)) ?></td></tr>
            </tbody>
        </table>
    </section>
<?php endif; ?>
