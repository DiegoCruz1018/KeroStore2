<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre del Producto" value="<?php echo s($producto->nombre); ?>">

    <label for="imagen">Imagen: </label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <?php if(isset($producto->imagen_actual)){ ?>
        <label>Imagen Actual:</label>
        <img src="/img/<?php echo $producto->imagen_actual ?>" class="imagen-small" alt="Imagen Producto">
    <?php } ?>

    <label for="precio">Precio: </label>
    <input type="text" id="precio" name="precio" placeholder="Precio del Producto" value="<?php echo s($producto->precio); ?>">

    <label for="cantidad">Cantidad de piezas: </label>
    <input type="text" id="cantidad" name="cantidad" placeholder="Cantidad de piezas del Producto" value="<?php echo s($producto->cantidad); ?>">

    <label for="talla">Talla: </label>
    <input type="text" id="talla" name="talla" placeholder="Talla del Producto" value="<?php echo s($producto->talla); ?>">
</fieldset>

<fieldset>
    <legend>Categoria del Producto</legend>

    <label for="categoria">Categoría</label>

    <select name="idCategoria" id="categoria">
        <option selected value="">-- Seleccione la categoria--</option>
        <?php foreach($categorias as $categoria): ?>
            <option <?php echo $producto->idCategoria === $categoria->id ? 'selected' : '' ?> 
                value="<?php echo s($categoria->id); ?>" > <?php echo s($categoria->nombre) ?> 
            </option>
        <?php endforeach; ?> 
    </select>
</fieldset>