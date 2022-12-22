<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('IMAGE_FOLDER2', '../images/');
define('IMAGE_FOLDER', '../../images/');

function includeTemplate( string $name, bool $index = false ) {
    include TEMPLATES_URL . "/${name}.php";
}

function authenticated() : void {
    session_start();

    if(!$_SESSION['logged']) {
        header('Location: /');
    }
}

function debbug($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Sanitizar el html
function sanitize($html) : string {
    $sanitized =  htmlspecialchars($html);
    return $sanitized;
}

// Validar tipo de contenido
function validateContentType($type) {
    $types = ['seller', 'property'];

    return in_array($type, $types);
}

// Mostrar los mensajes 
function showNotifications($code) {
    $message = '';

    switch($code) {
        case 1:
            $message = 'Creado Correctamente';
            break;
        case 2:
            $message = 'Actualizado Correctamente';
            break;
        case 3:
            $message = 'Eliminado Correctamente';
            break;
        default: 
            $message = false;
            break;
    }

    return $message;
}