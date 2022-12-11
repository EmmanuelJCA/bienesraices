<fieldset>
    <legend>Informacion General</legend>

    <label for="title">Titulo:</label>
    <input type="text" id="title" name="title" placeholder="Titulo de la propiedad" value="<?php echo sanitize( $property->title ) ?>">

    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" placeholder="Precio de la propiedad" value="<?php echo sanitize( $property->price ) ?>">

    <label for="image">Imagen:</label>
    <input type="file" id="image" name="image" accept="image/jpeg, image/png">

    <label for="description">Descripcion:</label>
    <textarea id="description" name="description"><?php echo sanitize( $property->description) ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion de la Propiedad</legend>

    <label for="bedrooms">Habitaciones:</label>
    <input type="number" id="bedrooms" name="bedrooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->bedrooms) ?>">

    <label for="parking">Estacionamiento:</label>
    <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->parking ) ?>">

    <label for="bathrooms">Baños:</label>
    <input type="number" id="bathrooms" name="bathrooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->bathrooms )?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
</fieldset>