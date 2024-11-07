<?php

namespace App;

class ActiveRecord{

//db
protected static $db;
protected static $columnasDB = [];
protected static $tabla = '';
protected static $where = '';
protected static $tablas = '';

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
public $nombre;
public $apellido;
public $telefono;

public static function setDB($database){

    /* self hace referencia a todos los statics */
    self::$db = $database;


}





public function Guardar(){



if(!is_null($this->id) ){

$this->actualizar();

}

else {


$this->crear();

}



}


public function crear(){

//sanitizar los datos

$atributos =  $this->sanitizarAtributos();

$query = "INSERT INTO ".  static::$tabla . " ("; 
$query .= join(', ', array_keys($atributos));
$query .= " ) VALUES (' "; 
$query .= join("', '", array_values($atributos));
$query .=  " ')";

$resultado = self::$db->query($query);

if($resultado){
    /*
    redireccionar al usuario
    el header solo funciona si anteriormente no hay html 
    */
    header('Location: /udemyphpcurso/BinesRaices/admin?codigo=1');


    }
return $resultado; 
}

public function actualizar(){

$atributos = $this->sanitizarAtributos();

$valores = [];
foreach ($atributos as $key => $valor) {

$valores[] = "{$key}='{$valor}'";


}

$query = "UPDATE ". static::$tabla . "  SET ";
$query .= join(', ', $valores);
$query .= " WHERE id='".self::$db->escape_string($this->id)."' ";
$query .= " LIMIT 1";

$resultado = self::$db->query($query);


if($resultado){
/*
redireccionar al usuario
el header solo funciona si anteriormente no hay html 
*/
header('Location: /udemyphpcurso/BinesRaices/admin?codigo=2');


}




}

//eliminar
public function eliminar(){

    $tablas = static::$tabla;

    if($tablas =='vendedores'){
        $query = " DELETE FROM ". static::$tabla  ." WHERE idVendedores = " . self::$db->escape_string($this->idVendedores)." LIMIT 1";
    }
    
    else if($tablas == 'propiedades'){
        $query = " DELETE FROM ". static::$tabla  ." WHERE id = " . self::$db->escape_string($this->id)." LIMIT 1";

}



$resultado = self::$db->query($query);

if($resultado){
    $this->borrarImagen();
    header('Location:/udemyphpcurso/BinesRaices/admin?codigo=3');
}

}



public function Atributos(){
$atributos = [];
foreach(static::$columnasDB as $columna){
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

$identificador = $this->id;

//elimina la imagen previa

if(!is_null($this->id)){
    
   $this->borrarImagen();

}



//asignar al atributo de la imagen ek nombre de la imagen
if($imagen){
    $this->imagen = $imagen;
}
}



//eliminar archivo de imagen
public function borrarImagen(){
//comprobamos si existe el archivo
$existeArchivo = file_exists(CARPETAS_IMAGENES.$this->imagen);
if($existeArchivo){
    unlink(CARPETAS_IMAGENES.$this->imagen);
}
}





//validacion

public static function getErrores(){


    static::$errores = [];
    return static::$errores;
}


public function validar(){


    
return static::$errores;
}


public static function all(){

$query = "SELECT * FROM ". static::$tabla;

$resultado = self::consultarSQL($query);

return $resultado;

}

//busca el registro por su id

public static function find($id){

$tablas = static::$tabla;

    if($tablas =='vendedores'){
        $where = " WHERE idVendedores = ";
    }
    
    else if($tablas == 'propiedades'){
   $where = " WHERE id = ";

}

    $query = "SELECT * FROM  " . static::$tabla . $where . $id ;
   

$resultado = self::consultarSQL($query);
return array_shift($resultado);

}
/*
public static function find($id){

$query = "SELECT * FROM  " . static::$tabla ." WHERE id = $id ";

$resultado = self::consultarSQL($query);
debuguear($resultado);
return array_shift($resultado);

}

*/




public static function consultarSQL($query){
//consulta la base de datos

$resultado = self::$db->query($query);


//iterar los resultados
$array = [];
while($registro = $resultado->fetch_assoc()){
$array[] = static::crearObjeto($registro);
}

//liberar memoria
$resultado->free();

//retornar los resultados

return $array;

}

protected static function crearObjeto($registro){

$objeto = new static;

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
            if(property_exists($this, $key)&& !is_null(($value))){
                $this->$key = $value;

            }
        }
    }





}

