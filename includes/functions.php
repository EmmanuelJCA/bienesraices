<?php

require 'app.php';

function includeTemplate( string $name, bool $index = false ) {
    include TEMPLATES_URL . "/${name}.php";
}