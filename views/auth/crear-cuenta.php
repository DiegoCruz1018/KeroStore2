<main class="contenedor seccion contenido-centrado">

    <h1>Crea una cuenta</h1>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/crear-cuenta">
        <fieldset>
            <legend>Llena el formulario</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>">

            <label for="apellido">Apellido: </label>
            <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>">

            <label for="telefono">Teléfono: </label>
            <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($usuario->email); ?>">

            <label for="password">Password: </label>
            <input type="password" id="password" name="password" placeholder="Tu Password">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Cuenta" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="/login">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/olvide-password">¿Olvidaste la contraseña?</a>
    </div>

</main>