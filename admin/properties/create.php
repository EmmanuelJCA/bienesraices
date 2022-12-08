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

    // Arreglo con mensajes de error
    $errors = [];

    $title = '';
    $price = '';
    $description = '';
    $bedrooms = '';
    $wc = '';
    $parking = '';
    $sellerId = '';

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $property = new Property($_POST);
        /** SUBIDA DE ARCHIVOS */

        // Generar un nombre unico
        $imageName = md5( uniqid( rand(), true) )  . ".jpg";
        
        // Realiza un resize a la imagen con intervention
        if($_FILES['image']['tmp_name']) {
            $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
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
            $result = $property->save();

            // Mostrar mensaje de error en caso de que haya uno
            if($result) {
                // Redireccionar al usuario

                header('Location: /admin/index.php?result=1');
            }
        }

        
    }

    includeTemplate('header');
?>

    <main class="container section">
        <h1>Crear</h1>

        <a href="/bienesraices/admin/index.php" class="button green-button">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" action="/admin/properties/create.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="title">Titulo:</label>
                <input type="text" id="title" name="title" placeholder="Titulo de la propiedad" value="<?php echo $title ?>">

                <label for="price">Precio:</label>
                <input type="number" id="price" name="price" placeholder="Precio de la propiedad" value="<?php echo $price ?>">

                <label for="image">Imagen:</label>
                <input type="file" id="image" name="image" accept="image/jpeg, image/png">

                <label for="description">Descripcion:</label>
                <textarea id="description" name="description"><?php echo $description ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="bedrooms">Habitaciones:</label>
                <input type="number" id="bedrooms" name="bedrooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo $bedrooms ?>">

                <label for="parking">Estacionamiento:</label>
                <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="bathrooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="sellerId">
                    <option value="" selected disabled>--Seleccione--</option>
                    <?php while($seller = mysqli_fetch_assoc($result)) : ?>
                        <option <?php echo $sellerId === $seller['id'] ? 'selected' : ''; ?> value="<?php echo $seller['id']; ?>"> <?php echo $seller['name'] . " " . $seller['surname'] ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>