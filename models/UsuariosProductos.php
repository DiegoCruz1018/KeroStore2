<?php

namespace Model;

class UsuariosProductos extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuariosproductos';
    protected static $columnasDB = ['id', 'idCompra', 'idProducto'];

    public $id;
    public $idCompra;
    public $idProducto;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->idCompra = $args['idCompra'] ?? '';
        $this->idProducto = $args['idProducto'] ?? '';
    }
}