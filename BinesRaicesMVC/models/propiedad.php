<?php

namespace Model;

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

public function validar(){

    if(!$this->titulo){
        self::$errores[] = "Debes añadir un titulo para la propiedad";
      }
     
    
              
        if(strlen($this->descripcion) < 5){
        self::$errores[] = "La descripción es obligatoria y debe tener al menos 10 caracteres";
      }
      if(!$this->habitaciones){
          self::$errores[] = "El numero de habitaciones es obligatorio ";
        }
        
        if(!$this->precio){
          self::$errores[] = "El precio es Obligatorio";
        }
        
        
        if(!$this->estacionamient){
            self::$errores[] = "El numero de estacionamientos es Obligatorio";
        }
        if(!$this->idVendedores){
            self::$errores[] = "Elige el vendedor";
        }
        return self::$errores;
    
        if(!$this->imagen){
        self::$errores[] = "la imagen de la propiedad es obligatoria";
        }
        
     
        
    return self::$errores;
    }
    

}