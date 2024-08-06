        <main class="contenedor">

            <?php if($auth): ?>
                <p class="id-cliente"><?php echo $id; ?></p>
                <h1 id="nombre-cliente" > Hola <span id="nombre-cliente-js"> <?php echo $nombre; ?> </span> </h1>
            <?php else: ?>
                <h1 id="nombre-cliente" > Hola <span id="nombre-cliente-js"> <?php echo '' ?> </span> </h1>
            <?php endif; ?>

            <h2>Nuestra Variedad</h2>

            <div class="info-publicidad">
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-playera.png" alt="Imagen playera">
                    </div>
                    <h3>Playeras</h3>
                </div>
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-gorro.png" alt="Imagen playera">
                    </div>
                    <h3>Gorras</h3>
                </div>
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-sueter.png" alt="Imagen playera">
                    </div>
                    <h3>Sueters</h3>
                </div>
            </div>
            
        </main>

        <section class="contenedor">
            <div class="vista-grid">
                <div class="vista1">
                    <img src="build/img/vista1.png" alt="vista 1">
                </div>
                <div class="vista2">
                    <img src="build/img/vista2.jpg" alt="vista 2">
                </div>
                <div class="vista3">
                    <img src="build/img/vista3.jpg" alt="vista 3">
                </div>
            </div>
        </section>

        <section class="contenedor productos">

            <!--
            <div class="info-publicidad">
                <?php //foreach($productos as $producto): ?>
                    <div class="publicidad">
                        <div class="diseño-producto">
                            <img class="producto-imagen" src="/img/<?php echo $producto->imagen; ?>" alt="Imagen playera">
                        </div>

                        <h3 class="nombre-producto" ><?php // echo $producto->nombre; ?></h3>

                        <p class="precio-producto"><?php // echo "$" . $producto->precio; ?></p>

                        <div id="agregar" class="agregar">
                            <a href="producto.php?id=<?php // echo $producto->id; ?>" class="boton-ver">Ver</a>
                            <button id="agregarCarrito" class="agregar-carrito boton-carrito-v1">Agregar</button>
                        </div>
                    </div>
                <?php //endforeach; ?>
            </div> 
            -->

            <nav class="tabs">
                <button type="button" class="actual" data-paso="1">Productos</button>
                <button type="button" data-paso="2">Carrito <span id="total-productos" class="cantidad-productos">0</span></button>
                <!-- <div class="contador-productos">
                    
                </div> -->
            </nav>

            <!-- MOSTRAR LOS PRODUCTOS EXTRAIDOS DESDE UNA API -->
            <div id="agregar-producto">

                <div id="paso-1" class="seccion">
                    <h3>Nuestros Productos</h3>
                    <div id="productos" class="info-publicidad"></div>
                </div> 
                
                <div id="paso-2" class="seccion">
                    <h3>Carrito</h3>
                    <div class="seccion-carrito">
                        <div id="lista-carrito" class="lista-carrito"></div>

                        <div class="carrito-pagar">
                            <h2 class="carrito-total-titulo">Total</h2>
                            <p id="total-pagar" class="carrito-total-precio">0</p>
                            <h2 class="carrito-total-titulo">Total de Productos</h2>
                            <p id="total-producto" class="carrito-total-productos">0</p>
                            <div class="carrito-boton-pagar">
                                <Button size="lg" class="boton-pagar">Proceder a Pagar</Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>