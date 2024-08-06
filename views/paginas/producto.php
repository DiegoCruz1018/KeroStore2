<?php
    require 'includes/app.php';

    use App\Producto;

    iniciarSession();

    $db = conectarDB();

    $auth = $_SESSION['login'] ?? false;
    $nombre = $_SESSION['nombre'] ?? false;

    //Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /kerostore/index.php');
    }

    //Obtener los datos del producto
    $producto = Producto::find($id);

    incluirTemplate('header');
?>

                <?php if($auth): ?>
                    <a href="/KeroStore/logout.php">Log Out</a>
                <?php else: ?>
                    <a href="/KeroStore/login.php">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

    <main class="contenedor">

        <?php if($auth): ?>
            <h1 id="nombre-cliente" >¿Te gusto este producto? <span id="nombre-cliente-js"> <?php echo $nombre; ?> </span> </h1>
        <?php endif; ?>

        <h1> <?php echo $producto->nombre; ?> </h1>

        <div class="producto-grid">
            <div class="producto-grid-imagen">
                <img src="/kerostore/imagenes/<?php echo $producto->imagen; ?>" alt="Imagen del producto">
            </div>

            <div class="producto-grid-info">

                <p class="producto-detalle"> Talla: <span class="producto-detalle-span"> <?php echo $producto->talla; ?> </span> </p>

                <p class="producto-detalle" > Precio: <span class="producto-detalle-span" ><?php echo "$" . $producto->precio; ?></span> </p>

                <form class="formulario" action="">
                    <label for="producto-detalle">Cantidad:</label>
                    <input type="number" id="cantidad" placeholder="Cantidad" min="1">
                </form>
                
            </div>
        </div>

    </main>

<?php 
    incluirTemplate('footer');
?>