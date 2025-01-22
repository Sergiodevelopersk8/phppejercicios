<?php

namespace MVC;

class Router{


    public $rutasGet = [];
    public $rutasPost = [];

    public function get($url, $fn){

        $this->rutasGet[$url] = $fn;

    }

    public function post($url, $fn){

        $this->rutasPost[$url] = $fn;

    }




    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGet[$urlActual] ?? null;
            
        }
        else{

            $fn = $this->rutasPost[$urlActual] ?? null;

        }
        




        if($fn){

        call_user_func($fn,$this);

        }
        else{
            echo 'pagina no encontrada';
        }

    }


    public function render($view, $datos = []){


        ob_start(); //almacenamiento en memoria durante un momento

        foreach($datos as $key => $value){
            $$key = $value; //$$key quiere decir variable de variable noi pierde el valor
        }

        include_once __DIR__ . "/views/$view.php";
        
        $contenido = ob_get_clean(); //LIMPIAR EL BUFFER

        include_once __DIR__ . '/views/layout.php';
    
    
    
    
    }







}