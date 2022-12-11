<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('IMAGE_FOLDER', '/../images/');

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