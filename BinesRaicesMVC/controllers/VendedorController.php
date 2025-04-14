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

    public static function actualizar(){
        echo 'Actualizar Vendedor';
    }
    
    public static function eliminar(){
        echo 'Eliminar Vendedor';
    }



}