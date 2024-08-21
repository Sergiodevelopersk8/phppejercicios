<?php


/*es para saber donde estan ubicados los templates para no poner los includes*/
/*EL _DIR_ PERMITE INCLUIR LAS UBICACIONES PARA APACHE */
define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
DEFINE('CARPETAS_IMAGENES', __DIR__. '/../imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false){

    include TEMPLATES_URL ."/$nombre.php";
}



// function estaAutenticado() : bool{
//     session_start();
//     $auth =$_SESSION['login'];
//     if($auth)
//     {
//         return true;
//     }
    
//      return false;
//     }

function estaAutenticado(){
    session_start();
    
    if(!$_SESSION['login'])
    {
        header('http://localhost/udemyphpcurso/BinesRaices/login.php');
    }
    
     
    }


    function debuguear($variable){
        echo '<pre>';

var_dump($variable);
echo '</pre>';

exit;
    }