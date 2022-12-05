<?php

    $result = $_GET['result'] ?? null;

    require '../includes/functions.php';
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($result) === 1): ?>
            <p class="alert success">Anuncio creado correctamente</p>
        <?php endif; ?>
        <a href="properties/create.php" class="button green-button">Nueva Propiedad</a>
    </main>

<?php
    includeTemplate('footer');
?>