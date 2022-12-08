<?php

    // Importar la conexionn
    require 'includes/app.php';
    $db = connectDB();

    // Crear un email y password
    $email = "emmanuelcanate@gmail.com";
    $password = "2008";
    
    // Hashear password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT); 

    // Query para crear el usuario
    $query = "INSERT INTO users (email, password) VALUES ( '${email}', '${passwordHash}')";


    // Agregamos a la BDD
    mysqli_query($db, $query);

?>