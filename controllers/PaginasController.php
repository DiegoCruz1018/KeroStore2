<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){

        //echo 'Desde index principal';
        session_start();
        //isAuth();

        $auth = $_SESSION['login'];

        $nombre = $_SESSION['nombre'] ?? false;
        $usuarioId = $_SESSION['id'];

        $productos = Producto::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'auth' => $auth,
            'nombre' => $nombre,
            'id' => $usuarioId,
            'productos' => $productos
        ]);
    }

    public static function carrito(Router $router){

        session_start();

        //$productos = Producto::all();
        
        $nombre = $_SESSION['nombre'] ?? false;

        $router->render('paginas/carrito', [
            'titulo' => 'Carrito',
            'nombre' => $nombre
        ]);
    }

    public static function contacto(Router $router){

        $alertas = [];

        $router->render('paginas/contacto', [
            'titulo' => 'Contacto',
            'alertas' => $alertas
        ]);
    }
}