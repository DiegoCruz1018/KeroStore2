<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CategoriaController;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\ProductoController;
use Model\Producto;
use MVC\Router;

$router = new Router();

//Login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crear-cuenta', [LoginController::class, 'crearCuenta']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Olvide password
$router->get('/olvide-password', [LoginController::class, 'olvide']);
$router->post('/olvide-password', [LoginController::class, 'olvide']);

//Recuperar Password
$router->get('/recuperar-password', [LoginController::class, 'recuperar']);
$router->post('/recuperar-password', [LoginController::class, 'recuperar']);

//Panel de administración
$router->get('/admin', [AdminController::class, 'index']);

//Categorias
$router->get('/categorias', [CategoriaController::class, 'index']);

$router->get('/categorias/crear', [CategoriaController::class, 'crear']);
$router->post('/categorias/crear', [CategoriaController::class, 'crear']);
$router->get('/categorias/actualizar', [CategoriaController::class, 'actualizar']);
$router->post('/categorias/actualizar', [CategoriaController::class, 'actualizar']);
$router->post('/categorias/eliminar', [CategoriaController::class, 'eliminar']);

//Productos
$router->get('/productos', [ProductoController::class, 'index']);

$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);


//Paginas
$router->get('/', [PaginasController::class, 'index']);

$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//Carrito
$router->get('/carrito', [PaginasController::class, 'carrito']);
$router->post('/carrito', [PaginasController::class, 'carrito']);

//API de carrito
$router->get('/api/productos', [APIController::class, 'index']);

$router->post('/api/carrito', [APIController::class, 'guardar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();