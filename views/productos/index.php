<main class="contenedor">
    <h1>Administrador de Productos</h1>

    <?php $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje): ?>
            <p class="alerta exito">
                <?php echo s($mensaje); ?>
            </p>
    <?php endif; ?>

    <a href="/admin" class="boton-datos">Volver</a>
    <a href="/productos/crear" class="boton-verde">Nuevo Producto</a>

    <h2>Productos</h2>

    <table class="productos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad de Piezas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
                <tr>
                    <td> <?php echo $producto->id; ?> </td>
                    <td> <?php echo $producto->nombre; ?> </td>
                    <td class="centrar-imagen">
                        <img src="/img/<?php echo $producto->imagen; ?>" class="imagen-tabla"> 
                    </td>
                    <td> <?php echo "$" . number_format($producto->precio); ?> </td>
                    <td> <?php echo $producto->cantidad; ?> </td>
                    <td>
                        <a href="/productos/actualizar?id=<?php echo $producto->id; ?>" class="boton-verde-block">Actualizar</a>

                        <form method="POST" class="w-100" action="/productos/eliminar">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="hidden" name="tipo" value="producto">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>