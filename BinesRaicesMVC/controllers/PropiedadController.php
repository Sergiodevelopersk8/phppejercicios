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
        $codigo = $_GET['codigo'] ?? null;
           
        $router->render('propiedades/admin',[
        'propiedades'=> $propiedades,
        'codigo'=> $codigo    
        ]);
        
    }
    public static function crear(Router $router){
        
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

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

        //    valida los errores 
          $errores = $propiedad-> validar();

          if(empty($errores)){
    
               
            if(!is_dir(CARPETAS_IMAGENES)){
                mkdir(CARPETAS_IMAGENES);
            }
            
            /* Asignar files hacia una variable  */
           
            $image->save(CARPETAS_IMAGENES . $nombreImagen);
            
            
            $resultado = $propiedad-> Guardar();
        
        
            }


        }


        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores

        ]   
    );
    }



    public static function actualizar(Router $router){
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        $id = validarORedireccionar('/admin');
        
        $propiedad = Propiedad::find($id);
        
        //ejecutar el código después de que el usuario envia el  formulario 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
   
        //asignar atributos
    
        $args = $_POST['propiedad'];
      
      
        $propiedad->sincronizar($args);
    
            // validar
    
        $errores = $propiedad->validar();
    
    
            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)).".jpg";
    
            //realiza resize
            if($_FILES['propiedad']['tmp_name']['image']){
    
            $manager = new Image(Driver::class);
            $image = $manager->read($_FILES['propiedad']['tmp_name']['image'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
            }
    
    
    
        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['image']){
    
                //almacenar la imagen
                $image->save(CARPETAS_IMAGENES.$nombreImagen);
            }
      
            $propiedad->guardar();
      
    
    
        }
    
    
    
    
    
        }



        $router -> render('/propiedades/actualizar',[
            'propiedad'=> $propiedad,
            'vendedores' => $vendedores,

            'errores' => $errores
        ]);

    }


    public static function eliminar( ){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }



        }
       


    }


} //fin de la clase