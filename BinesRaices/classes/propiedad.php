<?php

namespace App;



class Propiedad{

//db
    protected static $db;
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

    public static function setDB($database){

        /* self hace referencia a todos los statics */
        self::$db = $database;
    
    
    }
    


    public function __construct($args = [])
    {

        $this -> id = $args['id'] ??  '' ;
        $this -> titulo = $args['titulo'] ??  '' ;
        $this -> precio = $args['precio'] ??  '' ;
        $this -> imagen = $args['imagen'] ??  'imagen.jpg' ;
        $this -> descripcion = $args['descripcion'] ??  '' ;
        $this -> habitaciones = $args['habitaciones'] ??  '' ;
        $this -> wc = $args['wc'] ??  '' ;
        $this -> estacionamient = $args['estacionamient'] ??  '' ;
        $this -> creado = date('Y/m/d') ;
        $this -> idVendedores = $args['idVendedores'] ??  '' ;


        
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

    debuguear($resultado); 
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




}