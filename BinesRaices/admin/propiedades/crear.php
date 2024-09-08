<?php

require_once '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;



estaAutenticado();

$db = conectarDB();
$propiedad = new Propiedad;
// consultar los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);



//arreglo con mensajes de errores
$errores = Propiedad::getErrores();


$db = conectarDB();

//ejecutar el código después de que el usuario envia el  formulario 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   
  $propiedad = new Propiedad($_POST);
   
  $carpetaImagenes = '../../imagenes/';



//generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)).".jpg";


//realiza resize
    if($_FILES['image']['tmp_name']){

    $manager = new Image(Driver::class);
    $image = $manager->read($_FILES['image']['tmp_name'])->cover(800,600);
    $propiedad->setImagen($nombreImagen);
}



$errores = $propiedad-> validar();



if(empty($errores)){
    
    
    if(!is_dir(CARPETAS_IMAGENES)){
        mkdir(CARPETAS_IMAGENES);
    }
    
    /* Asignar files hacia una variable  */
   
    $image->save(CARPETAS_IMAGENES . $nombreImagen);
    
    
    $resultado = $propiedad-> Guardar();


    if($resultado){

header('Location: /udemyphpcurso/BinesRaices/admin?codigo=1');


    }

    }





}


require_once '../../includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        
        <a href ="/udemyphpcurso/BinesRaices/admin" class ="boton boton-verde">Volver</a>
       

<?php
for($i=0; $i<count($errores);$i++){?>
    <div class="alerta error">
    <?php echo $errores[$i]; ?>
</div>
<?php
}
?>

        <form class="formulario" method="POST"  action="/udemyphpcurso/BinesRaices/admin/propiedades/crear.php"
        enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php';?>
<input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');

/*

*/

?>