<?php

namespace MVC;


class Router{
    
    public $rutasGET = [];
    public $rutasPOST = [];
    
    public function get($url, $funcion){

        $this->rutasGET[$url] = $funcion;

    }
    public function post($url, $funcion){

        $this->rutasPOST[$url] = $funcion;

    }



    public function comprobarRutas()
    {
       
     $urlActual = $_SERVER['PATH_INFO'] ?? '/';
     $metodo = $_SERVER['REQUEST_METHOD'];
     
     if($metodo === 'GET' ){

         $funcion = $this->rutasGET[$urlActual] ?? null;
         
        }
        
        else{
            
            $funcion = $this->rutasPOST[$urlActual] ?? null;
       }



       //si la url si existe
       if($funcion){
        //se llama a la funcion aunque no se sabe como se llama
        call_user_func($funcion, $this);
       }
       else{
        echo 'página no encontrada';
       }

    }

    //muestra una vista

    public function render($view, $datos = []){

foreach ($datos as $key => $value) {
    //significa variable de variable
    $$key = $value;
}

        //inicia el servidor en memoria
        ob_start();
        include __DIR__ . "/views/$view.php";
        //limpia 
        $contenido = ob_get_clean();

        include __DIR__ ."/views/layout.php";

    }


}