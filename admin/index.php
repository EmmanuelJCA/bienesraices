<?php

    // Importar conexion
    require '../includes/config/database.php';
    $db = connectDB();

    // Escribir Query
    $query = "SELECT * FROM propiedades";

    // Consultar BDD
    $properties = mysqli_query($db, $query);

    // Muestra mensaje condicional
    $result = $_GET['result'] ?? null;

    // Incluye un template
    require '../includes/functions.php';
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($result) === 1): ?>
            <p class="alert success">Anuncio creado correctamente</p>
        <?php endif; ?>
        <a href="properties/create.php" class="button green-button">Nueva Propiedad</a>
    
        <table class="properties">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los Resultados -->
                <?php while( $property = mysqli_fetch_assoc($properties) ): ?>
                <tr>
                    <td><?php echo $property['id']; ?></td>
                    <td><?php echo $property['titulo']; ?></td>
                    <td> <img class="table-image" src="/bienesraices/images/<?php echo $property['imagen']; ?>"></img> </td>
                    <td><?php echo $property['precio']; ?>$</td>
                    <td>
                        <a href="#" class="yellow-button-block">Actualizar</a>
                        <a href="#" class="red-button-block">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar la conexion
    mysqli_close($db);
    includeTemplate('footer');
?>