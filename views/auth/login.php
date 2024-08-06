<main class="contenedor seccion contenido-centrado">

    <h1>Inicia Sesión</h1>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form action="/login" method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email" value="<?php echo $auth->email; ?>">

            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Tu Password">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Iniciar Sesión" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="/olvide-password">¿Olvidaste la contraseña?</a>
    </div>

</main>


<!-- <?php 
    //incluirTemplate('footer', $inicio = false, $abajo = true);
?> -->