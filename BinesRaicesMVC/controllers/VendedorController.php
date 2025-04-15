<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;


class VendedorController{

    public static function crear(Router $router){
       
        $vendedor =  new Vendedor();
       $errores = Vendedor::getErrores();

       if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $vendedor = new Vendedor($_POST['vendedor']);
    
        //validar campos vacios 
    
        $errores = $vendedor->validar();
        
        if(empty($errores)){
        $vendedor->guardar();
    }
    
    
    }


        $router->render('vendedores/crear',[
            
            'errores'=> $errores,
            'vendedor'=> $vendedor


        ]);
    }

    public static function actualizar(Router $router){
        
        $id = validarORedireccionarvendedor('/admin');
        //busca el id del vendedor
         $vendedor =  Vendedor::find($id);
        $errores = Vendedor::getErrores();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $args = $_POST['vendedor'];
        
            //sincronizar objeto en memoria
            $vendedor->sincronizar($args);
        
            //validar
            $errores = $vendedor->validar();
        
            if(empty($errores)){
                $vendedor->guardar();
            }
        
        
        }


        $router->render('vendedores/actualizar',[
            'vendedor'=> $vendedor,
            'errores'=> $errores
        ]);
    }
    
    public static function eliminar(){
        
      
        //busca el id del vendedor
           
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $idVendedores = $_POST['id'];
            
            
            $idVendedores = filter_var($idVendedores, FILTER_VALIDATE_INT);
            
            if($idVendedores){

                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)){
                    $vendedor =  Vendedor::find($idVendedores);
                    $vendedor->eliminar();
                }
            }



        }
        
    }



}