<?php

    // Validar que el usuario esta autenticado
    require '../../includes/app.php';

    use App\Property;
    use Intervention\Image\ImageManagerStatic as Image;

    authenticated();

    // Database
    $db = connectDB();

    // Consultar vendedores
    $query = "SELECT * FROM sellers";
    $result = mysqli_query($db, $query);

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $property = new Property($_POST['property']);

        /** SUBIDA DE ARCHIVOS */

        // Generar un nombre unico
        $imageName = md5( uniqid( rand(), true) )  . ".jpg";
        
        // Realiza un resize a la imagen con intervention
        if($_FILES['property']['tmp_name']['image']) {
            $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
            $property->setImage($imageName);
        }

        $errors = $property->validate();

        // Realizar INSERT si no hay errores
        if(empty($errors)) {

            // Crear carpeta para subir imagenes
            if(!is_dir(IMAGE_FOLDER)) {
                mkdir(IMAGE_FOLDER);
            }

            // Guardar la imagen en el servidor
            $image->save(IMAGE_FOLDER . $imageName);

            // Guardar en la base de datos
            $property->save();
            
        }
        
    }

    includeTemplate('header');
?>

    <main class="container section">
        <h1>Crear</h1>

        <a href="/admin" class="button green-button">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" action="/admin/properties/create.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/properties_form.php'; ?>

            <input type="submit" value="Crear Propiedad" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>