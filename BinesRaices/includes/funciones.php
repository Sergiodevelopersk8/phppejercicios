<?php


/*es para saber donde estan ubicados los templates para no poner los includes*/
/*EL _DIR_ PERMITE INCLUIR LAS UBICACIONES PARA APACHE */
define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
DEFINE('CARPETAS_IMAGENES', __DIR__. '/../imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false){

    include TEMPLATES_URL ."/$nombre.php";
}





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


    //escapa el html
    function sant($html){
$s = htmlspecialchars($html);
return $s;
    }


    //validar tipo de contenido

function validarTipoContenido($tipo){

    $tipos = ['vendedor','propiedad'];
    return in_array($tipo, $tipos);
/* 
for($i = 0; $i< count($tipos); $i++){
     if($tipo == $tipos[$i]){
         return $tipo;
     }
     else{
         return false;
     }
 }
     */
 
     

}


//muestra los mensjes

function mostrarNotificacion($codigo){

    $mensaje = '';

    switch($codigo){

        case 1 :
            $mensaje = 'Creado Correctamente';
            break;
        case 2 :
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3 :
            $mensaje = 'Eliminado Correctamente';
            break;
            
            default:
            $mensaje = false;
            break;


    }

return $mensaje;

}
