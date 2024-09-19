<?php

use App\Propiedad;

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
$errores = [];



//ejecutar el código después de que el usuario envia el  formulario 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   
  $args = $_POST['propiedad'];
  
  
  $propiedad->sincronizar($args);


  /* Asignar files hacia una variable  */
  $imagen = $_FILES['image'];


    if(!$titulo){
      $errores[] = "Debes añadir un titulo";
    }
    if(!$precio){
        $errores[] = "El precio es obligatorio";
            }

    if(strlen($descripcion) < 5){
      $errores[] = "La descripción es obligatoria y debe tener al menos 10 caracteres";
    }
    if(!$habitaciones){
        $errores[] = "El numero de habitaciones es obligatorio ";
      }

      if(!$precio){
        $errores[] = "El precio es Obligatorio";
      }

      
      if(!$estacionamiento){
        $errores[] = "El numero de estacionamientos es Obligatorio";
      }
      if(!$vendedorId){
        $errores[] = "Elige el vendedor";
      }


/*Validar peso de la imagen */
$medida = 1000 * 1000;
if($imagen['size'] > $medida){
  $errores[] = "La imagen es muy pesada";
}



if(empty($errores)){

  $carpetaImagenes = '../../imagenes/';

  if(!is_dir($carpetaImagenes)){
 
    mkdir($carpetaImagenes );
  }

  $nombreImagen = '';

/*Subir archivos */

if($imagen['name']){
  
/**eliminar la imagen previa */

unlink($carpetaImagenes . $propiedad['imagen'] );

//generar un nombre unico
$nombreImagen = md5(uniqid(rand(), true)).".jpg";

//subir la iamgen
move_uploaded_file($imagen['tmp_name'],$carpetaImagenes.$nombreImagen);

}

else{
  $nombreImagen = $propiedad['imagen'];
}

/*crear carpeta*/





$query = "UPDATE propiedades  SET titulo = '$titulo', precio =  '$precio',  imagen = '$nombreImagen',  descripcion = '$descripcion',
habitaciones = $habitaciones, wc = $wc,
estacionamient = $estacionamiento, idVendedores = $vendedorId  WHERE id = $id";




$resultado = mysqli_query($db,$query);

if($resultado){
/*
redireccionar al usuario
el header solo funciona si anteriormente no hay html 
*/
header('Location: /udemyphpcurso/BinesRaices/admin?codigo=2');


}

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