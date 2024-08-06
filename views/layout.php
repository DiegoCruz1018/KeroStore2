<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeroStore | <?php echo $titulo ?? ''; ?> </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor">
            <div class="barra">

                <a class="a-header" href="/"> Kero<span>Store</span> </a> 

                <div class="navegacion">
                    <?php if($_SESSION['admin']): ?>
                        <a href="/admin">Administrar</a>
                    <?php endif; ?>

                    <a href="/contacto">Contacto</a>
                    <a href="/carrito" class="">Carrito</a>

                    <?php if($_SESSION['login']): ?>
                        <a href="/logout">Log Out</a>
                    <?php else: ?>
                        <a href="/login">Log In</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header> 

    <?php echo $contenido; ?>

    <!-- <footer class="footer <?php //echo $abajo ? 'abajo' : ''; ?> <?php //echo $masAbajo ? 'mas-abajo' : ''; ?>">
        <div class="contenedor contenedor-footer">
            <div class="barra">
                <a class="a-header" href="/KeroStore/index.php"> Kero<span>Store</span> </a> 

                <div class="navegacion">
                    <a href="/KeroStore/login.php">Login</a>
                    <a href="/KeroStore/contacto.php">Contacto</a>
                    <a href="/KeroStore/carrito.php">Carrito</a>
                </div>
            </div>
        </div>
    </footer> -->

    <?php echo $script = '
        <script src="build/js/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    '; ?>
</body>
</html>