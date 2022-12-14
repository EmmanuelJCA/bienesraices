<fieldset>
    <legend>Informacion General</legend>

    <label for="title">Titulo:</label>
    <input type="text" id="title" name="property[title]" placeholder="Titulo de la propiedad" value="<?php echo sanitize( $property->title ) ?>">

    <label for="price">Precio:</label>
    <input type="number" id="price" name="property[price]" placeholder="Precio de la propiedad" value="<?php echo sanitize( $property->price ) ?>">

    <label for="image">Imagen:</label>
    <input type="file" id="image" name="property[image]" accept="image/jpeg, image/png">

    <?php if($property->image): ?>
        <img src="/images/<?php echo $property->image ?>" class="small-image" alt="Imagen de propiedad">
    <?php endif; ?>

    <label for="description">Descripcion:</label>
    <textarea id="description" name="property[description]"><?php echo sanitize( $property->description) ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion de la Propiedad</legend>

    <label for="bedrooms">Habitaciones:</label>
    <input type="number" id="bedrooms" name="property[bedrooms]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->bedrooms) ?>">

    <label for="parking">Estacionamiento:</label>
    <input type="number" id="parking" name="property[parking]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->parking ) ?>">

    <label for="bathrooms">Baños:</label>
    <input type="number" id="bathrooms" name="property[bathrooms]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize( $property->bathrooms )?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
</fieldset>