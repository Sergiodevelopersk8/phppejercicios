<?php

namespace Controllers;

use MVC\Router;

use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController{


public static function index(Router $router){
    

    $propiedades = Propiedad::all();
    
    //mensaje condicional
$codigo = $_GET['codigo'] ?? null;
    $router->render('propiedades/admin',[
    
      'propiedades' =>  $propiedades,
      'codigo' =>  $codigo,
    
    ]);




}
public static function crear(Router $router){

    $propiedad = new Propiedad;
    $vendedor = Vendedor::all();


    //arreglo con mensajes de errores
$errores = Propiedad::getErrores();

    //ejecutar el código después de que el usuario envia el  formulario 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $propiedad = new Propiedad($_POST['propiedad']);
     
    $carpetaImagenes = '../../imagenes/';
  
  
  
  //generar un nombre unico
      $nombreImagen = md5(uniqid(rand(), true)).".jpg";
  
  
  //realiza resize
  
      if($_FILES['propiedad']['tmp_name']['image']){
  
      $manager = new Image(Driver::class);
      $image = $manager->read($_FILES['propiedad']['tmp_name']['image'])->cover(800,600);
      $propiedad->setImagen($nombreImagen);
  }
  
  
  $errores = $propiedad-> validar();
  
  
  
  if(empty($errores)){
      
      
      if(!is_dir(CARPETAS_IMAGENES)){
          mkdir(CARPETAS_IMAGENES);
      }
      
      /* Asignar files hacia una variable  */
     
      $image->save(CARPETAS_IMAGENES . $nombreImagen);
      
      
       $propiedad-> Guardar();
  
  
      }
  
  }
  
    $router->render('propiedades/crear', [

        'propiedad'=> $propiedad,
        'vendedores'=>$vendedor,
        'errores' => $errores

    ]);
}


public static function actualizar(){
    echo "Actualizar propiedades";
}




}


