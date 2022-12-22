<?php
    require './includes/app.php';
    includeTemplate('header', $index = true);
?>

    <main class="container section">
        <h1>Más Sobre Nosotros</h1>
        <div class="us-icons">            
            <div class="icon">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Eveniet ea dignissimos, praesentium ex velit facilis consequuntur doloribus iure sequi tempore, et molestias optio fugiat sint, ad obcaecati omnis maxime. Perspiciatis.</p>
            </div>
            <div class="icon">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Eveniet ea dignissimos, praesentium ex velit facilis consequuntur doloribus iure sequi tempore, et molestias optio fugiat sint, ad obcaecati omnis maxime. Perspiciatis.</p>
            </div>
            <div class="icon">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Eveniet ea dignissimos, praesentium ex velit facilis consequuntur doloribus iure sequi tempore, et molestias optio fugiat sint, ad obcaecati omnis maxime. Perspiciatis.</p>
            </div>
        </div>
    </main>

    <section class="section container">
        <h1>Casas y Departamentos en venta</h1>
        
        <?php
            include 'includes\templates\advertisements.php';
        ?>

        <div class="align-right">
            <a href="advertisements.php" class="green-button">Ver Todas</a>
        </div>

    </section>

    <section class="contact-section">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contact.html" class="yellow-button">Contactanos</a>
    </section>

    <div class="container section lower-section">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="blog-entry">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada Blog">
                    </picture>
                </div>

                <div class="text-entry">
                    <a href="blogPost.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2022</span> por: <span>Admin</span></p>

                        <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>

            <article class="blog-entry">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada Blog">
                    </picture>
                </div>

                <div class="text-entry">
                    <a href="blogPost.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2022</span> por: <span>Admin</span></p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimonials">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis espectativas.
                </blockquote>
                <p>- Emmanuel Cañate</p>
            </div>
        </section>
    </div>

<?php
    includeTemplate('footer');
?>
