<?php
    // Importar Bdd
    require __DIR__ . '/../config/database.php';
    $db = connectDB();

    // Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limit}";

    // Obtener resultado
    $result = mysqli_query($db, $query);
?>

<div class="advertisements-container ">
    <?php while($property = mysqli_fetch_assoc($result)): ?>
    <div class="advertisement">

        <img loading="lazy" src="/bienesraices/images/<?php echo $property['imagen']; ?>" alt="anuncio">

        <div class="advertisement-content">
            <h3><?php echo $property['titulo']; ?></h3>
            <p><?php echo $property['descripcion']; ?></p>
            <p class="price"><?php echo $property['precio']; ?>$</p>

            <ul class="icons-features">
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $property['habitaciones']; ?></p>
                </li>
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $property['wc']; ?></p>
                </li>
                <li>
                    <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $property['estacionamiento']; ?></p>
                </li>
            </ul>

            <a href="/bienesraices/advertisement.php?id=<?php echo $property['id'] ?>" class="button yellow-button">
                Ver propiedad
            </a>
        </div><!--.advertisement-content-->
    </div><!--.advertisement-->
    <?php endwhile; ?>
</div><!--.advertisement-container-->

<?php 

    //Cerramos conexion
    mysqli_close($db);
?>