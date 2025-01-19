<?php

namespace Controllers;

use MVC\Router;

use Model\Propiedad;

class PropiedadController{


public static function index(Router $router){
    

        $propiedades = Propiedad::all();
    $codigo = null;

    $router->render('propiedades/admin',[
    
      'propiedades' =>  $propiedades,
      'codigo' =>  $codigo,
    
    ]);




}
public static function crear(Router $router){
    
    $router->render('propiedades/crear', [



    ]);
}


public static function actualizar(){
    echo "Actualizar propiedades";
}




}


