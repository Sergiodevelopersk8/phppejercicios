<?php
// require_once '../../includes/funciones.php';
require_once '../../includes/app.php';
use App\Propiedad;

$propiedad = new Propiedad();
echo '<pre>';

var_dump($propiedad);
echo '</pre>';

exit;


$auth = estaAutenticado();
if(!$auth)
{
    header('Location: /udemyphpcurso/BinesRaices/index.php');
}

// require '../../includes/config/database.php';
$db = conectarDB();

// consultar los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);



//arreglo con mensajes de errores
$errores = [];


$titulo = '';
$precio = '';
$descripcion = '';  
$habitaciones = '';  
$wc = '';  
$estacionamiento = '';  
$vendedorId = '';  
$creado = date('Y/m/d');
$imagen = null;  //variable para almacenar la imagen subida por el usuario

//ejecutar el código después de que el usuario envia el  formulario 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    $titulo = mysqli_real_escape_string( $db,$_POST['titulo']);
    $precio = mysqli_real_escape_string( $db,$_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db,$_POST[ 'descripcion']);  
    $habitaciones = mysqli_real_escape_string( $db,$_POST[ 'habitaciones']);  
    $wc = mysqli_real_escape_string( $db,$_POST[ 'wc']);  
    $estacionamiento = mysqli_real_escape_string( $db,$_POST[ 'estacionamiento']);  
    $vendedorId = mysqli_real_escape_string( $db,$_POST[ 'vendedor']);  

  /* Asignar files hacia una variable  */
  $imagen = $_FILES['image'];
// var_dump($_FILES);

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

      if(!$imagen['name'] || $imagen['error']){
      $errores[] = "la imagen es obligatoria";
      }

/*Validar peso de la imagen */
$medida = 1000 * 1000;
if($imagen['size'] > $medida){
  $errores[] = "La imagen es muy pesada";
}



if(empty($errores)){


/*Subir archivos

crear carpeta
*/


$carpetaImagenes = '../../imagenes/';

if(!is_dir($carpetaImagenes)){

  mkdir($carpetaImagenes );
}

//generar un nombre unico
$nombreImagen = md5(uniqid(rand(), true)).".jpg";

//subir la iamgen
move_uploaded_file($imagen['tmp_name'],$carpetaImagenes.$nombreImagen);


$query = "INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,
estacionamient,creado, idVendedores) 
values  ('$titulo','$precio',' $nombreImagen ',' $descripcion','$habitaciones','$wc',
'$estacionamiento', '$creado','$vendedorId')";


$resultado = mysqli_query($db,$query);

if($resultado){
/*
redireccionar al usuario
el header solo funciona si anteriormente no hay html 
*/
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text"  id="titulo" name="titulo" placeholder="Titulo  propiedad" 
                value =  "<?php echo $titulo; ?>" >
                
                <label for="precio">Precio: </label>
                <input type="number"  id="precio"  name="precio" placeholder="precio  propiedad"
                value =  "<?php echo $precio; ?>" >
                
                <label for="imagen">Imagen: </label>
                <input type="file"  id="imagen"  accept="image/jpeg, image/png" name="image" >

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" ><?php echo $descripcion; ?> </textarea>
                
            </fieldset>
            
            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number"  id="habitaciones" name= "habitaciones" 
                placeholder="Numero de habitaciones" min="1" max="9" value =  "<?php echo $habitaciones; ?>" >
                
                <label for="wc">Baños:</label>
                <input type="number"  id="wc" name="wc" placeholder="Numero de Baños" min="1" max="9"
                value =  "<?php echo $wc; ?>">
             

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number"  id="estacionamiento" name="estacionamiento" placeholder="Numero de Estacionamiento"
                 min="1" max="9" value =  "<?php echo $estacionamiento; ?>">
            
            </fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <select name="vendedor">
        <option value="">---Seleccione---</option>
      <?php while($vendedor = mysqli_fetch_assoc($resultado) ) {?>
        <!-- 
            $vendedorId === $vendedor['idVendedores'] si -> ? agrega -> 'selected' else -> : agrega -> '';
     -->
        <option <?php echo $vendedorId === $vendedor['idVendedores'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['idVendedores']; ?>"> <?php echo $vendedor['nombre'] ." " . $vendedor['apellido']; ?></option>  

<?php } ?>

    </select>
</fieldset>
<input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');

/*

*/

?>