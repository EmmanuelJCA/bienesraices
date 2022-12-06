<?php

    // Validar ID
    $propertyId = $_GET['id'];
    $propertyId = filter_var($propertyId, FILTER_VALIDATE_INT);

    if(!$propertyId) {
        header('Location: /bienesraices/index.php');
    }

    // Importar Bdd
    require __DIR__ . '/includes/config/database.php';
    $db = connectDB();

    // Consultar
    $query = "SELECT * FROM propiedades WHERE id = ${propertyId}";

    // Obtener resultado
    $result = mysqli_query($db, $query);
    $property = mysqli_fetch_assoc($result);

    if(!$result->num_rows) {
        header('Location: /bienesraices/index.php');
    }

    // Importar un template
    require './includes/functions.php';
    includeTemplate('header');
?>

<main class="container section center-content">
    <h1><?php echo $property['titulo']; ?></h1>

    <img loading="lazy" src="/bienesraices/images/<?php echo $property['imagen']; ?>" alt="imagen de la propiedad"> 
    
    <div class="sumary-property">
        <p class="price"><?php echo $property['precio']; ?>$</p>
    </div>

    <ul class="icons-features">
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $property['wc']; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $property['estacionamiento']; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $property['habitaciones']; ?></p>
        </li>
    </ul>
    
    <p>
        <?php echo $property['descripcion']; ?>
    </p>

</main>

<?php

    // Cerrar conexion DB
    // mysqli_close($db);

    // Incluir un template
    includeTemplate('footer');
?>
