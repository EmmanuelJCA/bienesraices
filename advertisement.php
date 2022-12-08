<?php

    // Validar ID
    $propertyId = $_GET['id'];
    $propertyId = filter_var($propertyId, FILTER_VALIDATE_INT);

    if(!$propertyId) {
        header('Location: /index.php');
    }

    require './includes/app.php';
    $db = connectDB();

    // Consultar
    $query = "SELECT * FROM properties WHERE id = ${propertyId}";

    // Obtener resultado
    $result = mysqli_query($db, $query);
    $property = mysqli_fetch_assoc($result);

    if(!$result->num_rows) {
        header('Location: /index.php');
    }

    // Importar un template
    includeTemplate('header');
?>

<main class="container section center-content">
    <h1><?php echo $property['title']; ?></h1>

    <img loading="lazy" src="/images/<?php echo $property['image']; ?>" alt="imagen de la propiedad"> 
    
    <div class="sumary-property">
        <p class="price"><?php echo $property['price']; ?>$</p>
    </div>

    <ul class="icons-features">
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $property['bathrooms']; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $property['parking']; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $property['bedrooms']; ?></p>
        </li>
    </ul>
    
    <p>
        <?php echo $property['description']; ?>
    </p>

</main>

<?php

    // Cerrar conexion DB
    // mysqli_close($db);

    // Incluir un template
    includeTemplate('footer');
?>
