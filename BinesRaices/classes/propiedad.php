<?php

namespace App;

use Intervention\Image\Colors\Hsv\Channels\Value;

class Propiedad{

//db
    protected static $db;
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamient','creado',
'idVendedores'];

//Errores

    protected static $errores = [];



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

    public static function setDB($database){

        /* self hace referencia a todos los statics */
        self::$db = $database;
    
    
    }
    


    public function __construct($args = [])
    {

        $this -> id = $args['id'] ??  '' ;
        $this -> titulo = $args['titulo'] ??  '' ;
        $this -> precio = $args['precio'] ??  '' ;
        $this -> imagen = $args['imagen'] ??  '' ;
        $this -> descripcion = $args['descripcion'] ??  '' ;
        $this -> habitaciones = $args['habitaciones'] ??  '' ;
        $this -> wc = $args['wc'] ??  '' ;
        $this -> estacionamient = $args['estacionamient'] ??  '' ;
        $this -> creado = date('Y/m/d') ;
        $this -> idVendedores = $args['idVendedores'] ??  1 ;
        

        
    }

public function Guardar(){
    
    //sanitizar los datos

    $atributos =  $this->sanitizarAtributos();
 
    $query = "INSERT INTO propiedades ("; 
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' "; 
    $query .= join("', '", array_values($atributos));
    $query .=  " ')";

    $resultado = self::$db->query($query);

    return $resultado; 
}

public function Atributos(){
    $atributos = [];
    foreach(self::$columnasDB as $columna){
        if($columna === 'id') continue;
$atributos[$columna] = $this->$columna;
    }
    return $atributos;
}


public function sanitizarAtributos(){

    $atributos = $this->Atributos();
    $sanitizado = [];
    foreach($atributos as $key => $value){
        $sanitizado[$key] = self::$db->escape_string($value);
    }

    return$sanitizado;


 }

//subir imagenes

public function setImagen($imagen){
    if($imagen){
        $this->imagen = $imagen;
    }
}




 //validacion

 public static function getErrores(){
    
    return self::$errores;
 }


 public function validar(){
    
    if(!$this->titulo){
        self::$errores[] = "Debes añadir un titulo";
      }
      if(!$this->precio){
          self::$errores[] = "El precio es obligatorio";
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
        self::$errores[] = "la imagen es obligatoria";
        }
        
     
        
  return self::$errores;
 }


public static function all(){

$query = "SELECT * FROM propiedades";

$resultado = self::consultarSQL($query);

return $resultado;

}

//busca la propiedad por su id
public static function find($id){

    $query = "SELECT * FROM  propiedades WHERE id = $id ";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);

}


public static function consultarSQL($query){
//consulta la base de datos

$resultado = self::$db->query($query);


//iterar los resultados
$array = [];
while($registro = $resultado->fetch_assoc()){
    $array[] = self::crearObjeto($registro);
}

//liberar memoria
$resultado->free();

//retornar los resultados

return $array;

}

protected static function crearObjeto($registro){

    $objeto = new self;

    foreach($registro as $key => $value ){
        if(property_exists($objeto, $key)){
            $objeto->$key = $value;
        }
    }
return $objeto;
}


        //sincronizar en memoria los cambios relizado por el usuario

        public function sincronizar($args = []){
            foreach($args as $key=> $value){
                if(property_exists($this, $key)&& is_null(($value))){
                    $this->$key = $value;

                }
            }
        }





}