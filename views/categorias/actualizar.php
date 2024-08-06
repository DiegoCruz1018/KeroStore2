<main class="contenedor seccion">

    <h1>Actualizar Categoria</h1>

    <a href="/categorias" class="boton-datos">Volver</a>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <div class="alinear-derecha">
            <input type="submit" value="Actualizar Categoria" class="boton-verde">
        </div>

    </form>

</main>