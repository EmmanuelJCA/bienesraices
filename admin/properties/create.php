<?php
    require '../../includes/functions.php';
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Crear</h1>
        <a href="/admin/index.php" class="button green-button">Volver</a>

        <form class="form" action="POST">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="title">Titulo:</label>
                <input type="text" id="title" placeholder="Titulo de la propiedad">

                <label for="price">Precio:</label>
                <input type="number" id="price" placeholder="Precio de la propiedad">

                <label for="image">Imagen:</label>
                <input type="file" id="image" accept="image/jpeg, image/png">

                <label for="description">Descripcion:</label>
                <textarea id="description"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>

                <label for="bedrooms">Habitaciones:</label>
                <input type="number" id="bedrooms" placeholder="Ej: 3" min="1" max="9">

                <label for="parking">Estacionamiento:</label>
                <input type="number" id="parking" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select>
                    <option value="1">Emmanuel</option>
                    <option value="2">Juan</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>