    <main class="container section">
        <h1>Administrador de Bienes Raices</h1>

        <?php

            if($result) {
                $message = showNotifications($result);
                if($message) { ?>
                    <p class="alert success"><?php echo sanitize($message); ?></p>
        <?php }
            } 
        ?>

        <a href="/properties/create" class="button green-button">Nueva Propiedad</a>
        <a href="sellers/create" class="button yellow-button">Nuevo vendedor</a>

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
                        <a href="/properties/update?id=<?php echo $property->id; ?>" class="yellow-button-block">Actualizar</a>
                        
                        <form method="POST" action="properties/delete" class="w-100" >
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
                    <td><?php echo $seller->phone; ?></td>
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
    