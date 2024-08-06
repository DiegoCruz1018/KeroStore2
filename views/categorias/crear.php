<main class="contenedor seccion">

    <h1>Nueva Categoria</h1>

    <a href="/categorias" class="boton-datos">Volver</a>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/categorias/crear">
        
        <?php include_once __DIR__ . '/formulario.php'; ?>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Categoria" class="boton-verde">
        </div>
    </form>

</main>