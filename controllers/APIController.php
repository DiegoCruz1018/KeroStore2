<?php

namespace Controllers;

use Model\Compra;
use Model\Producto;
use Model\UsuariosProductos;

class APIController{
    public static function index(){
        $producto = Producto::all();

        echo json_encode($producto);
    }

    public static function guardar(){
        /*
        $resultado = [
            'datos' => $_POST
        ];

        echo json_encode(['resultado' => $resultado]);
        */

        session_start();

        //Almacena la compra y devuelve el ID
        $compra = new Compra($_POST);
        $resultado = $compra->guardar();

        // $respuesta = [
        //     'compra' => $compra
        // ];

        //Almacena la cita y el servicio

        $id = $resultado['id'];

        //Almacena los productos con el ID de la cita
        $idProductos = explode(",", $_POST['productos']);

        foreach($idProductos as $idProducto){
            $args = [
                'idCompra' => $id,
                'idProducto' => $idProducto
            ];

            $usuariosProductos = new UsuariosProductos($args);
            $usuariosProductos->guardar();
        }

        // $resultado = [
        //     'productos' => $idProductos
        // ];

        //Retornamos respuesta
        // $respuesta = [
        //     'resultado' => $resultado
        // ];
        
        echo json_encode($resultado);
    }
}