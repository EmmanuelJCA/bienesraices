<?php

require '../../includes/app.php';

use App\Seller;

authenticated();

$seller = new Seller();

// Arreglos con mensajes de errores
$errors = Seller::getErrors();

// Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Crear una nueva instancia
    $seller = new Seller($_POST['seller']);

    $errors = $seller->validate();

    if(empty($errors)) {
        $seller->save();
    }
}

includeTemplate('header');
?>

<main class="container section">
        <h1>Registrar Vendedor</h1>

        <a href="/admin" class="button green-button">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" action="/admin/sellers/create.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/sellers_form.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>