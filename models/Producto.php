<?php

namespace Model;

class Producto extends ActiveRecord{

    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'precio', 'cantidad', 'idCategoria', 'talla', 'creado'];

    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $cantidad;
    public $idCategoria;
    public $talla;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '' ;
        $this->imagen = $args['imagen'] ?? '';
        $this->precio = $args['precio'] ?? '' ;
        $this->cantidad = $args['cantidad'] ?? '' ;
        $this->idCategoria = $args['idCategoria'] ?? '';
        $this->talla = $args['talla'] ?? '';
        $this->creado = date('Y-m-d');
    }

    public function validarProducto(){

        if(!$this->nombre){
            self::$alertas['error'][] = "Debes añadir un nombre";
        }

        if(!$this->imagen){
            self::$alertas['error'][] = "La imagen es obligatoria";
        }

        if(!$this->precio){
            self::$alertas['error'][] = "El precio es obligatorio";
        }

        if(!$this->cantidad){
            self::$alertas['error'][] = "La cantidad de piezas es obligatorio";
        }

        if(!$this->talla){
            self::$alertas['error'][] = "La talla es obligatoria";
        }

        if(!$this->idCategoria){
            self::$alertas['error'][] = "Debes añadir una categoría";
        }

        return self::$alertas;
    }
}