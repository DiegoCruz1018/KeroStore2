<?php 

namespace Model;

class Compra extends ActiveRecord{

    protected static $tabla = 'compra';
    protected static $columnasDB = ['id', 'fecha', 'idUsuario', 'total'];

    public $id;
    public $fecha;
    public $idUsuario;
    public $total;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = date('Y-m-d');
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->total = $args['total'] ?? '';
    }
}