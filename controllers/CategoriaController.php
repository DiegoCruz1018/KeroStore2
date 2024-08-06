<?php

namespace Controllers;

use Model\Categoria;
use MVC\Router;

class CategoriaController{
    public static function index(Router $router){

        session_start();
        isAdmin();

        //Traer todas las categorias
        $categorias = Categoria::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('categorias/index',[
            'titulo' => 'Categorias',
            'categorias' => $categorias,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){

        session_start();
        isAdmin();

        $alertas = [];

        $categoria = new Categoria;

        //Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Creando una nueva instancia
            $categoria = new Categoria($_POST);

            //debuguear($categoria);

            //Validar
            $alertas = $categoria->validarCategoria();

            if(empty($alertas)){

                //Guarda en la base de datos
                $categoria->guardar();

                header('Location: /categorias?resultado=1');
            }
        }

        $alertas = Categoria::getAlertas();

        $router->render('categorias/crear', [
            'titulo' => 'Nueva Categoria',
            'alertas' => $alertas,
            'categoria' => $categoria
        ]);
    }

    public static function actualizar(Router $router){

        session_start();
        isAdmin();
        
        //Validar la URL por ID válido
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /categorias/index');
        }

        //Obtener los datos de la categoria
        $categoria = Categoria::find($id);

        //Arreglo con errores
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Sincronizar objeto en memoria con lo que el usuario escribio
            $categoria->sincronizar($_POST);

            //Validación
            $alertas = $categoria->validarCategoria();

            if(empty($alertas)){

                $categoria->guardar();

                header('Location: /categorias?resultado=2');
            }
        }

        $router->render('categorias/actualizar', [
            'titulo' => 'Actualizar Categoria',
            'alertas' => $alertas,
            'categoria' => $categoria
        ]);
    }

    public static function eliminar(){

        session_start();
        isAdmin();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                $tipo = $_POST['tipo'];

                //debuguear($tipo);

                if(validarTipoContenido($tipo)){
                    //Compara lo que vamos a eliminar
                    $categoria = Categoria::find($id);

                    //debuguear($categoria);

                    $categoria->eliminar();

                    header('Location: /categorias?resultado=3');
                }
            }
        }

    }
}