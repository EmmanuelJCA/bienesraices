<main class="container section">
        <h1>Actualizar Vendedor</h1>

        <a href="/admin" class="button green-button">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" enctype="multipart/form-data">

            <?php include __DIR__ . '/form.php'; ?>

            <input type="submit" value="Actualizar Vendedor" class="button green-button">
        </form>
</main>