<?php

function connectDB() : mysqli {
    $db = new mysqli('localhost', 'root', '2008', 'bienesraices_crud');

    if(!$db) {
        echo "Error al conectar con la base de datos";
        exit;
    }

    return $db;
}