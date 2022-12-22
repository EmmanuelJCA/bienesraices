<?php
    require './includes/app.php';
    includeTemplate('header');
?>

    <main class="container section">
        <h1>Conoce sobre Nosotros</h1>

        <div class="aboutUs-content">
            <div class="image">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="aboutUs-text">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis. 
                </p>
            </div>
        </div>
    </main>

    <section class="container section">
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
    </section>

<?php
    includeTemplate('footer');
?>
