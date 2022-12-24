<fieldset>
    <legend>Informacion General</legend>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="seller[name]" placeholder="Nombre del vendedor" value="<?php echo sanitize( $seller->name ) ?>">

    <label for="surname">Apellido:</label>
    <input type="text" id="surname" name="seller[surname]" placeholder="Apellido del vendedor" value="<?php echo sanitize( $seller->surname ) ?>">
</fieldset>

<fieldset>
    <legend>Informacion de Contacto</legend>

    <label for="phone">Telefono:</label>
    <input type="text" id="phone" name="seller[phone]" placeholder="Nombre del vendedor" value="<?php echo sanitize( $seller->phone ) ?>">
</fieldset>