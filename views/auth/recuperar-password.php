<main class="contenedor contenido-centrado margin-top-2">
    <h1>Recuperar Password</h1>
    <h3>Coloca tu nuevo passsword a continuación</h3>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Tu Nuevo Password">

        <div class="alinear-derecha">
            <input type="submit" class="boton-submit" value="Guardar Nuevo Password">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="crear-cuenta.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="olvide-password.php">¿Aún no tienes cuenta? Crea Una</a>
    </div>
</main>