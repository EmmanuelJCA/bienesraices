<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['logged'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $index ? 'index' : ''; ?>">
        <div class="container header-content">
            <div class="bar">
                <a href="index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                
                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Icono expandir menu">
                </div>
                
                <div class="rigth">
                    <img class="dark-mode-button" src="/bienesraices/build/img/dark-mode.svg">
                    <nav class="navigation">
                        <a href="aboutUs.php">Nosotros</a>
                        <a href="advertisements.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contact.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/bienesraices/logout.php">Cerrar Sesion</a> 
                        <?php endif; ?>
                    </nav>
                </div>

            </div><!--.bar-->

            <?php if($index) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>