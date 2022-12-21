<?php

    // Verificar si el usuario esta autenticado
    require '../includes/app.php';
    authenticated();

    use App\Property;
    use App\Seller;

    // Implementar un metodo para obtener todas las propiedades
    $properties = Property::all();
    $sellers = Seller::all();    

    // Muestra mensaje condicional
    $result = $_GET['result'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       $id = $_POST['id'];
       $id = filter_var($id, FILTER_VALIDATE_INT);

       if($id) {

        $type = $_POST['type'];

        if(validateContentType($type)) {
            if($type === 'seller') {
                $seller = Seller::find($id);
                $seller->delete();  
            } elseif ($type === 'property') {
                $property = Property::find($id);
                $property->delete();   
            }
        } else {
            
        } 
       }
    }

    // Incluye un template
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Administrador de Bienes Raices</h1>

        <?php if( intval($result) === 1 ): ?>
            <p class="alert success">Creado Correctamente</p>
        <?php elseif( intval($result) === 2 ): ?>
            <p class="alert success">Actualizado Correctamente</p>
        <?php elseif( intval($result) === 3 ): ?>
            <p class="alert success">Eliminado Correctamente</p>
        <?php endif; ?>
        <a href="properties/create.php" class="button green-button">Nueva Propiedad</a>
        <a href="sellers/create.php" class="button yellow-button">Nuevo vendedor</a>

        <h2>Propiedades</h2>
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
                            <input type="hidden" name="type" value="property">
                            <input type="submit" class="red-button-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="properties">
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los Resultados -->
                <?php foreach( $sellers as $seller): ?>
                <tr>
                    <td><?php echo $seller->id; ?></td>
                    <td><?php echo $seller->name . " " . $seller->surname; ?></td>
                    <td><?php echo $seller->phone; ?>$</td>
                    <td>
                        <a href="sellers/update.php?id=<?php echo $seller->id; ?>" class="yellow-button-block">Actualizar</a>
                        
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                            <input type="hidden" name="type" value="seller">
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