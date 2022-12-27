<main class="container section">
    <h1>Contacto</h1>

    <?php 
        if($message) {
            echo  '<p class="alert success">' . $message. '</p>';
        }
    ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/destacada3.jpg" alt="Imagen de Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>
    <form action="/contact" class="form" method="POST">
        <fieldset>
            <legend>Información personal</legend>
            
            <label for="name">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="name" name="contact[name]" required>

            <label for="message">Mensaje:</label>
            <textarea id="message" name="contact[message]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend> 

            <label for="options">Vende o compra:</label>
            <select id="options" name="contact[type]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="purchase">Compra</option>
                <option value="sell">Vende</option>
            </select>


            <label for="budget">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu precio o Presupuesto" id="budget" name="contact[budget]" required> 
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>¿Cómo desea ser contactado?</p>

            <div class="way-contact">
                <label for="contact-phone">Teléfono</label>
                <input type="radio" value="phone" id="contact-phone" name="contact[contact]" required>

                <label for="contact-email">E-mail</label>
                <input type="radio" value="email" id="contact-email" name="contact[contact]" required>
            </div>

            <div id="contact"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="green-button">
    </form>
</main>