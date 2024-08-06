<?php

namespace Controllers;

use MVC\Router;

class AdminController{

    public static function index(Router $router){

        session_start();

        isAdmin();

        $nombre = $_SESSION['nombre'];

        $router->render('admin/index', [
            'titulo' => 'Administración',
            'nombre' => $nombre
        ]);
    }
}