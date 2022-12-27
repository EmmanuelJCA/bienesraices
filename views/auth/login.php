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