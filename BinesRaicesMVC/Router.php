<?php

namespace MVC;

class Router{


    public $rutasGet = [];
    public $rutasPost = [];

    public function get($url, $fn){

        $this->rutasGet[$url] = $fn;



    }




    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGet[$urlActual] ?? null;
            
        }
        

        if($fn){

        call_user_func($fn,$this);

        }
        else{
            echo 'pagina no encontrada';
        }

    }


    public function render($view, $datos = []){


        foreach($datos as $key => $value){
            $$key = $value;
        }




        ob_start(); //almacenamiento en memoria durante un momento
        include_once __DIR__ . "/views/$view.php";
        
        $contenido = ob_get_clean(); //LIMPIAR EL BUFFER

        include_once __DIR__ . '/views/layout.php';
    
    
    
    
    }







}