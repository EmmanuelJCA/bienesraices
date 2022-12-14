<?php

    // Verificar si el usuario esta autenticado

    use App\Property;
    use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    
    authenticated();

    // Validar ID
    $propertyId = $_GET['id'];
    $propertyId = filter_var($propertyId, FILTER_VALIDATE_INT);

    if(!$propertyId) {
        header('Location: /admin/index.php');
    }

    // Database
    $db = connectDB();

    // Obtener los datos de la propiedad
    $property = Property::find($propertyId);

    // Consultar vendedores
    $query = "SELECT * FROM sellers";
    $result = mysqli_query($db, $query);

    // Arreglo con mensajes de error
    $errors = Property::getErrors();

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Asignar atributos
        $args = $_POST['property'];

        $property->sync($args);

        $errors = $property->validate();

        /** SUBIDA DE ARCHIVOS */

        // Generar un nombre unico
        $imageName = md5( uniqid( rand(), true) )  . ".jpg";

        // Realiza un resize a la imagen con intervention
        if($_FILES['property']['tmp_name']['image']) {
            $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
            $property->setImage($imageName);
        }

        // Realizar INSERT si no hay errores
        if(empty($errors)) {
            $image->save(IMAGE_FOLDER . $imageName);
            $result =  $property->save();
        }
    }


    includeTemplate('header');
?>

    <main class="container section">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="button green-button">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/properties_form.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>