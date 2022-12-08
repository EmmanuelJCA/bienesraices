<?php
    // Importar Bdd
    $db = connectDB();

    // Consultar
    $query = "SELECT * FROM properties LIMIT ${limit}";

    // Obtener resultado
    $result = mysqli_query($db, $query);
?>

<div class="advertisements-container ">
    <?php while($property = mysqli_fetch_assoc($result)): ?>
    <div class="advertisement">

        <img loading="lazy" src="/images/<?php echo $property['image']; ?>" alt="anuncio">

        <div class="advertisement-content">
            <h3><?php echo $property['title']; ?></h3>
            <p><?php echo $property['description']; ?></p>
            <p class="price"><?php echo $property['price']; ?>$</p>

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

            <a href="/advertisement.php?id=<?php echo $property['id'] ?>" class="button yellow-button">
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