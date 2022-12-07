<?php

require 'app.php';

function includeTemplate( string $name, bool $index = false ) {
    include TEMPLATES_URL . "/${name}.php";
}

function authenticated() : bool {
    session_start();
    $auth = $_SESSION['logged'];

    if($auth) {
        return true;
    }
    return false;
}