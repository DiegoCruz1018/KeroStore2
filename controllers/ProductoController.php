<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Categoria;

class ProductoController{
    public static function index(Router $router){

        session_start();
        isAdmin();

        //Implementar un método para obtener todas las propiedades
        $productos = Producto::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('productos/index',[
            'titulo' => 'Productos',
            'productos' => $productos,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){

        session_start();
        isAdmin();

        $producto = new Producto;

        //Consulta para obtener todas las categorias
        $categorias = Categoria::all();

        //Arreglo con mensajes de errores
        $alertas = [];

        //Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Creando una nueva instancia
            $producto = new Producto($_POST);

            /** SUBIDA DE ARCHIVOS **/

            //Generar un nombre único para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //debuguear($nombreImagen);

            //debuguear($_FILES['imagen']["tmp_name"]);

            //Setear la imagen
            //Realiza un resize a la imagen con intervention
            if($_FILES['imagen']["tmp_name"]){

                //debuguear($_FILES['imagen']["tmp_name"]);

                //$image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600);
                $image = Image::make($_FILES['imagen']["tmp_name"])->fit(800,600);
                $producto->setImagen($nombreImagen);

                //debuguear($producto);
            }

            //Validar
            $alertas = $producto->validarProducto();

            //debuguear($producto);

            //debuguear($alertas);

            if(empty($alertas)){

                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $resultado = $producto->guardar();

                if($resultado){
                    header('Location: /productos?resultado=1');
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render('productos/crear', [
            'titulo' => 'Nuevo Producto',
            'alertas' => $alertas,
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

    public static function actualizar(Router $router){

        session_start();
        isAdmin();

        //Validar la URL por ID válido
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /productos');
        }

        //Obtener los datos del producto
        $producto = Producto::find($id);

        // if($producto){
        //     header('Location: /productos');
        // }

        //Obtener todas las categorias
        $categorias = Categoria::all();

        //debuguear($producto);

        //Arreglo con errores
        $alertas = [];

        $producto->imagen_actual = $producto->imagen;

        //debuguear($producto->imagen_actual);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //debuguear($producto);

            //debuguear($alertas);

            //SUBIDA DE ARCHIVOS

            //Setear la imagen
            //Realiza un resize a la imagen con intervention
            if(!empty($_FILES['imagen']["tmp_name"])){

                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                $image = Image::make($_FILES['imagen']["tmp_name"])->fit(800,600);
                //$producto->setImagen($nombreImagen);

                //Generar un nombre único para la imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                $_POST['imagen'] = $nombreImagen;
            }else{
                $_POST['imagen'] = $producto->imagen_actual;
            }

            //debuguear($producto);

            $producto->sincronizar($_POST);

            //debuguear($producto);

            //Validación
            $alertas = $producto->validarProducto();

            if(empty($alertas)){

                //Si existe una nueva imagen
                if(isset($nombreImagen)){
                    //Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $resultado = $producto->actualizar();

                if($resultado){
                    header('Location: /productos?resultado=2');
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render('productos/actualizar', [
            'titulo' => 'Actualizar Producto',
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }
    
    public static function eliminar(Router $router){

        session_start();
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)){
                    //Compara lo que vamos a eliminar
                    if($tipo === 'producto'){
                        $producto = Producto::find($id);
                        $resultado = $producto->eliminar();

                        if($resultado){
                            header('Location: /productos?resultado=3');
                        }
                    }
                }
            }
        }
    }
}