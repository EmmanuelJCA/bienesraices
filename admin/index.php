<?php

    // Verificar si el usuario esta autenticado
    require '../includes/app.php';
    authenticated();

    use App\Property;

    // Implementar un metodo para obtener todas las propiedades
    $properties = Property::all();

    // Muestra mensaje condicional
    $result = $_GET['result'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       $propertyId = $_POST['id'];
       $propertyId = filter_var($propertyId, FILTER_VALIDATE_INT);

       if($propertyId) {

        // Eliminar archivo 
        $query = "SELECT image FROM properties WHERE id = ${propertyId}";

        $result = mysqli_query($db, $query);
        $property = mysqli_fetch_assoc($result);

        unlink('../images/' . $property['image']);

        // Eliminar propiedad
          $query = "DELETE FROM properties WHERE id = ${propertyId}";
          $result = mysqli_query($db, $query);

          if($result) {
             header('Location: /admin/index.php?result=3');
          }
       }
    }

    // Incluye un template
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Administrador de Bienes Raices</h1>

        <?php if( intval($result) === 1 ): ?>
            <p class="alert success">Anuncio Creado Correctamente</p>
        <?php elseif( intval($result) === 2 ): ?>
            <p class="alert success">Anuncio Actualizado Correctamente</p>
        <?php elseif( intval($result) === 3 ): ?>
            <p class="alert success">Anuncio Eliminado Correctamente</p>
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
                <?php foreach( $properties as $property): ?>
                <tr>
                    <td><?php echo $property->id; ?></td>
                    <td><?php echo $property->title; ?></td>
                    <td> <img class="table-image" src="/images/<?php echo $property->image; ?>"></img> </td>
                    <td><?php echo $property->price; ?>$</td>
                    <td>
                        <a href="properties/update.php?id=<?php echo $property->id; ?>" class="yellow-button-block">Actualizar</a>
                        
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                            <input type="submit" class="red-button-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

<?php

    // Cerrar la conexion
    mysqli_close($db);
    includeTemplate('footer');
?>