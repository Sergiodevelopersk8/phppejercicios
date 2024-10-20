<?php

namespace App;

use Intervention\Image\Colors\Hsv\Channels\Value;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';


    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamient','creado',
    'idVendedores'];

public $id;
public $titulo;
public $precio;
public $imagen;
public $descripcion;
public $habitaciones;
public $wc;
public $estacionamient;
public $creado;
public $idVendedores;


public function __construct($args = [])
{

    $this -> id = $args['id'] ??  null ;
    $this -> titulo = $args['titulo'] ??  '' ;
    $this -> precio = $args['precio'] ??  '' ;
    $this -> imagen = $args['imagen'] ??  '' ;
    $this -> descripcion = $args['descripcion'] ??  '' ;
    $this -> habitaciones = $args['habitaciones'] ??  '' ;
    $this -> wc = $args['wc'] ??  '' ;
    $this -> estacionamient = $args['estacionamient'] ??  '' ;
    $this -> creado = date('Y/m/d') ;
    $this -> idVendedores = $args['idVendedores'] ??  '' ;
    

    
}



}