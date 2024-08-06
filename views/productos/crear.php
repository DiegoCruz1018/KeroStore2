<main class="contenedor seccion">

    <h1>Nuevo Producto</h1>

    <a href="/productos" class="boton-datos">Volver</a>

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="/productos/crear" enctype="multipart/form-data">
        
        <?php include_once __DIR__ . '/formulario.php'; ?>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Producto" class="boton-verde">
        </div>
    </form>

</main>