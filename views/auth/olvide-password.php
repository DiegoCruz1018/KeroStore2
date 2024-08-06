
<main class="contenedor seccion contenido-centrado margin-top">

    <h1>Olvide mi Password</h1>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/olvide-password">
        <fieldset>
            <legend>Restablece tu password</legend>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Enviar Instrucciones" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea Una</a>
    </div>

</main>