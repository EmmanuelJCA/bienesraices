<main class="container section">
    <h3>Actualizar Propiedad</h3>

    <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/admin" class="button green-button">Volver</a>

    <form class="form" method="POST" enctype="multipart/form-data">

        <?php include __DIR__ . '/form.php'; ?>

        <input type="submit" value="Crear Propiedad" class="button green-button">
    </form>
</main>