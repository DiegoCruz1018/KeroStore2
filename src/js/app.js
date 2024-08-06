let paso = 1;
const pasoInicial = 1;
const pasoFinal = 2;

const carrito = {
    id: '',
    nombre: '',
    productos: [],
    total: ''
};

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){

    mostrarSección();
    tabs();

    consultarAPI(); //Consulta la API en el backend de PHP

    nombreCliente(); //Añade el nombre del cliente al objeto de carrito
    idCliente();
}

function mostrarSección(){
    //console.log('Mostrando Sección');

    //Ocultar la sección que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la sección con el paso
    const pasoSelector = `#paso-${paso}`;
    //console.log(pasoSelector);
    const seccion = document.querySelector(pasoSelector);
    //console.log(seccion);

    seccion.classList.add('mostrar');

    //Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

    //console.log(tab);
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    //console.log(botones);

    //Iterar en cada boton
    botones.forEach(boton => {
        boton.addEventListener('click', function(e){
            // console.log('diste click');
            // console.log(e);

            // console.log(e.target.dataset.paso);
            // console.log(typeof e.target.dataset.paso);
            //console.log(parseInt(e.target.dataset.paso));

            paso = parseInt(e.target.dataset.paso);

            //console.log(paso);

            mostrarSección();
        });
    });
}

async function consultarAPI(){
    try {
        const url = '/api/productos';
        const resultado = await fetch(url);
        const productos = await resultado.json();

        mostrarProductos(productos);
        //mostrarBtnAgregarProducto(productos);
    } catch (error) {
        console.log(error);
    }
}

function nombreCliente(){
    carrito.nombre = document.querySelector('#nombre-cliente-js').textContent;
}

function idCliente(){
    carrito.id = document.querySelector('.id-cliente').textContent;
}


function mostrarProductos(productos){
    productos.forEach(producto =>{
        const {id, nombre, imagen, precio} = producto;

        /* PRODUCTOS DEL INDEX */
        //DIV para la imagen del producto
        const imagenProducto = document.createElement('DIV');
        imagenProducto.innerHTML =`<img class="producto-imagen" src="img/${imagen}" alt="Imagen playera"> `;
        imagenProducto.classList.add('diseño-producto');

        //Nombre del producto
        const nombreProducto = document.createElement('H3');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = nombre;

        //Precio del producto
        const precioProducto = document.createElement('P');
        precioProducto.classList.add('precio-producto');
        precioProducto.textContent = `$${precio}`;

        //Div para el boton agregar y el boton ver
        const agregarDiv = document.createElement('DIV')
        agregarDiv.innerHTML = `<a href="producto.php?id=${id}" class="boton-ver">Ver</a>`;
        agregarDiv.classList.add('agregar');

        const btnAgregar = document.createElement('BUTTON');
        btnAgregar.classList.add('agregar-carrito');
        btnAgregar.classList.add('boton-agregar');
        btnAgregar.textContent = 'Agregar';
        btnAgregar.dataset.idProducto = id;
        btnAgregar.onclick = function(){
            // const claseProducto = document.querySelector('#agregar-producto');
            // claseProducto.classList.add('agregar-producto');

            // const claseInfoPubli = document.querySelector('#productos');
            // claseInfoPubli.classList.remove('info-publicidad');
            // claseInfoPubli.classList.add('info-publicidad2');

            agregarCarrito(producto);
            
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Agregado Correctamente",
                showConfirmButton: false,
                timer: 1500
            });
        }

        agregarDiv.appendChild(btnAgregar);

        //Div para cada producto
        const productoDiv = document.createElement('DIV');
        productoDiv.classList.add('publicidad');

        //Añadiendo las diferentes secciones al div de productos
        productoDiv.appendChild(imagenProducto);
        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(precioProducto);
        productoDiv.appendChild(agregarDiv);

        //Añadiendo todo el div del producto al div con el id 'productos' que esta en el HTML
        document.querySelector('#productos').appendChild(productoDiv);
    });
}

/*
function mostrarBtnAgregarProducto(productos){
    
    productos.forEach(producto =>{
        const { id } = producto;

        const agregarBtn = document.createElement('BUTTON');
        agregarBtn.classList.add('agregar-carrito');
        agregarBtn.classList.add('boton-carrito-v2');
        agregarBtn.textContent = 'Agregar';
        agregarBtn.dataset.idProducto = id;
        agregarBtn.onclick = function(){
            agregarCarrito(producto);
        }

        //Añadiendo el boton btnAgregar a la página del producto
        document.querySelector('.producto-grid-info').appendChild(agregarBtn);
    });
}
*/


function agregarCarrito(producto){

    //console.log(producto);

    const { id } = producto;

    //Extraer el arreglo de servicios
    const {productos} = carrito

    //Identificar el elemento al que se le da click
    //const agregarBtn = document.querySelector(`[data-id-producto="${id}"]`);

    //Comprobar si un servicio ya fue agregado
    //if(productos.some(agregado => agregado.id === id)){
        //Agregar Cantidad

        //Filter nos permite sacar un elemento basado en cierta condición
        // carrito.productos = productos.filter(agregado => agregado.id != id);
        // agregarBtn.classList.remove('boton-agregado');
        // agregarBtn.classList.add('boton-carrito-v2');
        // agregarBtn.textContent = 'Agregar';

        
    //}else{
        //Agregarlo
        // agregarBtn.classList.remove('boton-carrito-v2')
        // agregarBtn.classList.add('boton-agregado');
        // agregarBtn.textContent = 'Agregado';

        //Toma una copia y se agrega el nuevo producto
        //carrito.productos = [...productos, producto];
    //}

    const listProducts = document.querySelector('#productos')
    listProducts.addEventListener('click', function(e){
        //console.log(e.target);
        //console.log(e.target.classList.contains('boton-agregar'));

        if(e.target.classList.contains('boton-agregar')){
            //console.log(e.target.parentElement.parentElement);
            
            //Accedemos al elemento padre del elemento al que se dio click
            //En este caso lo ponemos doble vez (.parentElement) porque queremos el
            //Elemento padre del padre
            const product = e.target.parentElement.parentElement

            //Accedemos al contenido de ese h3
            //console.log(product.querySelector('h3').textContent);

            const infoProduct = {
                id: producto.id,
                quantity: 1,
                title: product.querySelector('h3').textContent,
                price: product.querySelector('p').textContent
            }

            //console.log(infoProduct);

            //const { productos } = carrito;

            const exists = productos.some(product => product.id === infoProduct.id)

            //console.log(exists);

            if(exists){
                const products = carrito.productos.map(product =>{
                    if(product.id === infoProduct.id){
                        product.quantity++;

                        // carrito.unidades.producto = product.id;
                        // carrito.unidades.cantidad = product.cantidad;
                        return product;
                    }else{
                        return product;
                    }
                });

                carrito.productos = [...products];
            }else{
                carrito.productos = [...productos, infoProduct];
            }

            //console.log(carrito);

            showListProducts(); //Mostramos la lista de productos
        }
    });

    const rowProduct = document.querySelector('.lista-carrito');

    rowProduct.addEventListener('click', function(e){

        //console.log(e.target.classList.contains('boton-eliminar'));

        if(e.target.classList.contains('boton-eliminar')){
            const productInfo = e.target.parentElement.parentElement;
            //console.log(producto);
            //const productInfoId = producto.id;

            //console.log(productInfoId);

            const id = productInfo.querySelector('.producto-id').textContent;
            //const price = productInfo.quantity('p').textContent;

            carrito.productos = carrito.productos.filter(producto => producto.id !== id);

            //console.log(carrito.productos);
            showListProducts();
            // const carritoPagar = document.querySelector('.carrito-pagar');
            // carritoPagar.innerHTML = '';

            // const listaCarrito = document.getElementById('lista-carrito');
            // listaCarrito.remove();
            
            // const infoPublicidad = document.querySelector('#productos');
            // infoPublicidad.classList.remove('info-publicidad2');
            // infoPublicidad.classList.add('info-publicidad');
        }
    });

    //console.log(carrito);
}

/*
function seleccionarCantidadProducto(){
    // const inputCantidad = document.querySelector('#cantidad');
    // inputCantidad.addEventListener('input', function(){
    //     carrito.unidades = inputCantidad.value;
    // })

    const listProducts = document.querySelector('#productos')
    listProducts.addEventListener('click', function(e){
        //console.log(e.target.classList.contains('boton-agregar'));

        if(e.target.classList.contains('boton-agregar')){
            //console.log(e.target.parentElement.parentElement);
            
            //Accedemos al elemento padre del elemento al que se dio click
            //En este caso lo ponemos doble vez (.parentElement) porque queremos el
            //Elemento padre del padre
            const product = e.target.parentElement.parentElement

            //Accedemos al contenido de ese h3
            //console.log(product.querySelector('h3').textContent);

            const infoProduct = {
                quantity: 1,
                title: product.querySelector('h3').textContent,
                price: product.querySelector('p').textContent
            }

            //console.log(infoProduct);

            const { productos } = carrito;

            carrito.productos = [...productos, infoProduct];

            //console.log(carrito);
        }
    });
}
*/

function showListProducts(){

    // console.log('Lista de productos');
    // return;

    //const carritoList = document.querySelector('.lista-carrito');
    const carritoList = document.querySelector('.lista-carrito')

    // if(!carrito.productos.length){
    //     contadorProductos.innerHTML = `
    //         <p class="carrito-vacio">El carrito esta vacio</p>
    //     `;
    // }

    //console.log(carritoList);

    //Limpiar HTML
    carritoList.innerHTML = '';

    let total = 0;
    let totalOfProducts = 0;
    
    const { productos } = carrito;

    //const valorTotal = document.querySelector('.carrito-total-productos')
    const contadorProductos = document.querySelector('#total-productos');

    productos.forEach(product => {
        //console.log(product);
        const containerProduct = document.createElement('DIV');
        containerProduct.classList.add('list-products');

                                                      //Quitamos el $
        total = total + parseInt(product.quantity * product.price.slice(1));
        totalOfProducts = totalOfProducts + product.quantity;

        containerProduct.innerHTML = `
            <div class="carrito">
                <!-- <h1 class="carrito-titulo">Carrito de compras</h1> -->
                <div class="carrito-info">
                    <div class="producto-info">
                        <p class="producto-id">${product.id}</p>
                        <h2 class="producto-nombre">${product.title}</h2>
                        <p class="producto-precio">${product.price}</p>
                        <div class="carrito-botones">
                            <div class="carrito-cantidad">
                                <!-- <Button
                                variant="outline"
                                size="sm"
                                class="boton-cantidad"
                                id="boton-restar"
                                >
                                -
                                </Button> -->
                                <span class="producto-cantidad">Cantidad: ${product.quantity}</span>
                                
                                <!-- <Button class="boton-cantidad boton-sumar" id="boton-sumar">
                                +
                                </Button> -->
                            </div>
                            <Button class="boton-eliminar">
                                Eliminar
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // <div class="carrito-pagar">
        //         <h2 class="carrito-total-titulo">Total</h2>
        //         <p class="carrito-total-precio">${total}</p>
        //         <h2 class="carrito-total-titulo">Total de Productos</h2>
        //         <p class="carrito-total-productos">${totalOfProducts}</p>
        //         <div class="carrito-boton-pagar">
        //             <Button size="lg" class="boton-pagar">Proceder al checkout</Button>
        //         </div>
        //     </div>

        //console.log(containerPagoCarrito);
        //console.log(carritoList);

        carritoList.append(containerProduct);
    });

    //const listaCarrito = document.querySelector('.lista-carrito')

    // const containerPagoCarrito = document.createElement('DIV');
    // containerPagoCarrito.classList.add('carrito-pagar');

    // containerPagoCarrito.innerHTML = `
    //     <h2 class="carrito-total-titulo">Total</h2>
    //     <p class="carrito-total-precio">$${total}</p>
    //     <h2 class="carrito-total-titulo">Total de Productos</h2>
    //     <p class="carrito-total-productos">${totalOfProducts}</p>
    //     <div class="carrito-boton-pagar">
    //         <Button size="lg" class="boton-pagar">Proceder a Pagar</Button>
    //     </div>
    // `;

    //console.log(carritoList.parentElement);

    //const apoyo = document.querySelector('#apoyo');

    //const elementoPadre = carritoList.parentElement;
    //elementoPadre.insertBefore(containerPagoCarrito, apoyo);

    //carritoList.append(containerPagoCarrito);
    //elementoPadre.appendChild(containerPagoCarrito);

    const totalPagar = document.querySelector('#total-pagar');
    totalPagar.innerText = `$${total}`;

    const totalProducto = document.querySelector('#total-producto');
    totalProducto.innerText = `${totalOfProducts}`;

    carrito.total = total;
    
    //const valorTotal = document.querySelector('.precio-producto');
    //console.log(valorTotal);

    // const countProducts = document.querySelector('#contador-productos');

    // valorTotal = total;
    // valorTotal = innerText = `$${total}`;
    //countProducts.innerText = totalOfProducts;

    // console.log(total);
    // console.log(totalOfProducts);

    contadorProductos.innerText = totalOfProducts;

    const botonPagar = document.querySelector('.boton-pagar');
    botonPagar.onclick = comprarProductos; 
}

async function comprarProductos(){
    //console.log(carrito);
    const { id, nombre, productos, unidades, total } = carrito;

    //Se crea un solo objeto de formdata
    const datos = new FormData(); //Es como el submit en javascript

    //El map coloca las coincidencias las coloca en la variable idProductos
    const idProductos = productos.map( producto => producto.id );
    //console.log(idProductos);

    //const cantidad = unidades.producto = idProductos; 

    //append es la forma en que podemos agregar datos a este fromdata
    datos.append('idUsuario', id);
    datos.append('productos', idProductos);
    //datos.append('unidades', );
    //datos.append('unidades', cantidad);
    datos.append('total', total);

    // console.log(carrito);
    // console.log(datos);
    //console.log([...datos]);

    try {
        
        //Petición hacia la API
        const url = `/api/carrito`; //Funciona cuando el backend y el js esta alojado en el mismo dominio
        //const url = `${location.origin}/api/citas`;
        //const url = `http://localhost:3000/api/citas`;

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        })

        //console.log(respuesta);

        const resultado = await respuesta.json();
        //console.log(resultado);
        //console.log(resultado.resultado);

        //return;

        if(resultado.resultado){
            Swal.fire({
                icon: "success",
                title: "Compra Pagada",
                text: "Tu compra fue pagada correctamente",
                // footer: '<a href="#">Why do I have this issue?</a>'
                button: 'OK'
            }).then( () => {

                setTimeout( () => {
                    window.location.reload();
                }, 1000);

            });
        }

    } catch (error) {
        //console.log(error);

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al pagar",
            // footer: '<a href="#">Why do I have this issue?</a>'
            //button: 'OK'
          })
    }
}