<?php

use App\Propiedad;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

require_once '../../includes/app.php';

estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
header('Location:/udemyphpcurso/BinesRaices/admin/');

}


/**Obtener los datos de la propiedad  */

 
$propiedad = Propiedad::find($id);



// consultar los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//arreglo con mensajes de errores
$errores = Propiedad::getErrores();




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

  //almacenar la imagen
  $image->save(CARPETAS_IMAGENES.$nombreImagen);
  
        $propiedad->guardar();
  


    }





    }


incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        
        <a href ="/udemyphpcurso/BinesRaices/admin" class ="boton boton-verde">Volver</a>
       

<?php
for($i=0; $i<count($errores);$i++){?>
    <div class="alerta error">
    <?php echo $errores[$i]; ?>
</div>
<?php
}
?>

        <form class="formulario" method="POST"  
        enctype="multipart/form-data">
           <?php include '../../includes/templates/formulario_propiedades.php'; ?>
<input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');

/*

*/

?>