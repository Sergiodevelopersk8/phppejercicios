<?php

require_once '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;



estaAutenticado();

$db = conectarDB();

// consultar los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);



//arreglo con mensajes de errores
$errores = Propiedad::getErrores();



$titulo = '';
$precio = '';
$descripcion = '';  
$habitaciones = '';  
$wc = '';  
$estacionamient = '';  
$vendedorId = '';  
$creado = date('Y/m/d');
$imagen = null;  //variable para almacenar la imagen subida por el usuario



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
                <input type="number"  id="estacionamient" name="estacionamient" placeholder="Numero de Estacionamiento"
                 min="1" max="9" value =  "<?php echo $estacionamient; ?>">
            
            </fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <select name="idVendedores">
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