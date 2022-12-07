<?php

    // Importar la conexionn
    require __DIR__ . '/includes/config/database.php';
    $db = connectDB();

    // Arreglo de errores
    $errors = [];

    // Autenticar usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errors[] = "El email es obligatorio";
        }
        if(!$password) {
            $errors[] = "El password es obligatorio";
        }

        if(empty($errors)) {

            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $result = mysqli_query($db, $query);

            if($result->num_rows) {
                // Revisar si el password es correcto 
                $user = mysqli_fetch_assoc($result);


                // Verificar si el password es correcto
                $auth = password_verify($password, $user['password']);

                if($auth) {
                    // El usuario esta autenticado
                    session_start();

                    // Llenar arreglo de la sesion
                    $_SESSION['user'] = $user['email'];
                    $_SESSION['logged'] = true;

                    header('Location: /bienesraices/admin/index.php');                    

                } else {
                    $errors [] = "El password es incorrecto";
                }

            } else {
                $errors[] = "El usuario no existe";
            }
        }
    }

    // Incluir Template
    require 'includes/functions.php';
    includeTemplate('header');
?>

    <main class="container section center-content">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errors as $error): ?>
            <div class="alert error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="form">
        <fieldset>
                <legend>Email y Password</legend>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" required>
 
                <label for="password">Teléfono</label>
                <input type="password" name="password" placeholder="Tu contrasenia" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="button green-button">
        </form>
    </main>

<?php
    includeTemplate('footer');
?>