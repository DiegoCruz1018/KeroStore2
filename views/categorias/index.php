<main class="contenedor">

    <h2>Categorias</h2>

    <?php $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje): ?>
            <p class="alerta exito">
                <?php echo s($mensaje); ?>
            </p>
    <?php endif; ?>

    <a href="/admin" class="boton-datos">Regresar</a>
    <a href="/categorias/crear" class="boton-verde">Nueva Categoria</a>

    <table class="productos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $categoria): ?>
                <tr>
                    <td> <?php echo $categoria->id; ?> </td>
                    <td> <?php echo $categoria->nombre; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/categorias/eliminar">
                            <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                            <input type="hidden" name="tipo" value="categoria">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/categorias/actualizar?id=<?php echo $categoria->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>