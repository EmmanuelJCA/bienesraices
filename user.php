<?php

    // Importar la conexionn
    require __DIR__ . '/includes/config/database.php';
    $db = connectDB();

    // Crear un email y password
    $email = "emmanuelcanate@gmail.com";
    $password = "2008";
    
    // Hashear password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT); 

    // Query para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}')";


    // Agregamos a la BDD
    mysqli_query($db, $query);

?>