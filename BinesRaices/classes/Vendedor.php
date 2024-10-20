<?php

namespace App;

class Vendedor extends ActiveRecord{


    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['idVendedores','nombre','apellido','telefono'];

    public $idVendedores;
    public $nombre;
    public $apellido;
    public $telefono;



    public function __construct($args = [])
    {
    
        $this -> idVendedores = $args['idVendedores'] ??  null ;
        $this -> nombre = $args['nombre'] ??  '' ;
        $this -> apellido = $args['apellido'] ??  '' ;
        $this -> telefono = $args['telefono'] ??  '' ;
        
        
    
        
    }



}