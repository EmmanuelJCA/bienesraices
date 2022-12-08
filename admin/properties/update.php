<?php

    // Verificar si el usuario esta autenticado
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
    $query = "SELECT * FROM properties WHERE id = ${propertyId}";
    $result = mysqli_query($db, $query);
    $property = mysqli_fetch_assoc($result);

    // Consultar vendedores
    $query = "SELECT * FROM sellers";
    $result = mysqli_query($db, $query);

    // Arreglo con mensajes de error
    $error = [];

    $title = $property['title'];
    $price = $property['price'];
    $description = $property['description'];
    $bedrooms = $property['bedrooms'];
    $wc = $property['bathrooms'];
    $parking = $property['parking'];
    $sellerId = $property['seller_id'];
    $propertyImage = $property['image'];

    // Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $title = mysqli_real_escape_string($db, $_POST['title']);
        $price = mysqli_real_escape_string($db, $_POST['price']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $bedrooms = mysqli_real_escape_string($db, $_POST['bedrooms']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $parking = mysqli_real_escape_string($db, $_POST['parking']);
        $sellerId = mysqli_real_escape_string($db, $_POST['seller']);
        $created = date('Y/m/d');

        $image = $_FILES['image'];

        // Validaciones
        if(!$title) {
            $error[] = "El Titulo es obligatorio";
        }
        if(!$price) {
            $error[] = "El precio es obligatorio";
        }
        if(strlen($description) < 50) {
            $error[] = "La descripcion debe contener al menos 50 caracteres";
        }
        if(!$bedrooms) {
            $error[] = "El numero de habitaciones es obligatorio";
        }
        if(!$wc) {
            $error[] = "El numero de banios es obligatorio";
        }
        if(!$parking) {
            $error[] = "El numero de estacionamientos es obligatorio";
        }
        if(!$sellerId) {
            $error[] = "Debe seleccionar un vendedor";
        }

        // Validar imagen por peso
        if($image['size'] > 100000) {
            $error[] = 'La imagen es muy pesada';
        }

        // Realizar INSERT si no hay errores
        if(empty($error)) {

            /** SUBIDA DE ARCHIVOS */

            // Crear carpeta
            $imageFolder = '../../images/';
             if(!is_dir($imageFolder)) {
                mkdir($imageFolder, true);
            }

            $imageName = '';

            if($image['name']) {

                // Eliminar la imagen previa
                unlink($imageFolder . $property['image']);

                // Generar un nombre unico
                $imageName = md5( uniqid( rand(), true) )  . ".jpg";

                // Subir imagen
                move_uploaded_file($image['tmp_name'], $imageFolder . $imageName);
            } else {
                $imageName = $property['image'];
            }

            //Insertar en la base de datos
            $query = " UPDATE properties SET title = '${title}', price = '${price}', image = '${imageName}', description = '${description}', bedrooms = ${bedrooms}, bathrooms = ${wc}, parking = ${parking}, seller_id = ${sellerId} WHERE id = ${propertyId} ";

            $result = mysqli_query($db, $query);

            if($result) {
                // Redireccionar al usuario

                header('Location: /admin/index.php?result=2');
            }
        }

        
    }

    includeTemplate('header');
?>

    <main class="container section">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin/index.php" class="button green-button">Volver</a>

        <?php foreach($error as $err): ?>
        <div class="alert error">
            <?php echo $err; ?>
        </div>
        <?php endforeach; ?>

        <form class="form" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="title">Titulo:</label>
                <input type="text" id="title" name="title" placeholder="Titulo de la propiedad" value="<?php echo $title ?>">

                <label for="price">Precio:</label>
                <input type="number" id="price" name="price" placeholder="Precio de la propiedad" value="<?php echo $price ?>">

                <label for="image">Imagen:</label>
                <input type="file" id="image" name="image" accept="image/jpeg, image/png">
                <img class="small-image" src="/bienesraices/images/<?php echo $propertyImage; ?>">

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
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="seller">
                    <option value="" selected disabled>--Seleccione--</option>
                    <?php while($seller = mysqli_fetch_assoc($result)) : ?>
                        <option <?php echo $sellerId === $seller['id'] ? 'selected' : ''; ?> value="<?php echo $seller['id']; ?>"> <?php echo $seller['name'] . " " . $seller['surname'] ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>