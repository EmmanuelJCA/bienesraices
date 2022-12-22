<?php
    require './includes/app.php';
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/destacada3.jpg" alt="Imagen de Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>
        <form action="" class="form">
            <fieldset>
                <legend>Información personal</legend>
                
                <label for="name">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="name">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu E-mail" id="email">
 
                <label for="phone">Teléfono</label>
                <input type="tel" placeholder="Tu teléfono" id="phone">

                <label for="message">Mensaje:</label>
                <textarea id="message"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend> 

                <label for="options">Vende o compra:</label>
                <select>
                   <option value="" disabled selected>-- Seleccione --</option>
                   <option value="purchase">Compra</option>
                   <option value="sell">Vende</option>
                </select>


                <label for="budget">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu precio o Presupuesto" id="budget"> 
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>¿Cómo desea ser contactado?</p>

                <div class="way-contact">
                    <label for="contact-phone">Teléfono</label>
                    <input name="contact" type="radio" value="Phone" id="contact-phone">

                    <label for="contact-email">E-mail</label>
                    <input name="contact" type="radio" value="email" id="contact-email">
                </div>

                <p>Si eligió teléfono, elija una fecha y hora</p>

                <label for="date">Fecha:</label>
                <input type="date" id="date"> 
                
                <label for="hour">Hora:</label>
                <input type="time" id="hour" min="09:00" max="18:00"> 
 
            </fieldset>

            <input type="submit" value="Enviar" class="green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>
