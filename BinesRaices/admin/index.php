<?php
require_once '../includes/funciones.php';

$auth = estaAutenticado();
if(!$auth)
{
    header('Location: /udemyphpcurso/BinesRaices/index.php');
}


//importar la conecxion
require '../includes/config/database.php';
$db = conectarDB();

//escribir el query
$query = "SELECT * FROM propiedades";

//consultar db
$resultadoConsulta = mysqli_query( $db, $query );

//mensaje condicional
$codigo = $_GET['codigo'] ?? null;


if($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $id= $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){

        $query = "SELECT imagen FROM propiedades  WHERE id='$id'";
$resultado = mysqli_query( $db, $query );
$propiedad = mysqli_fetch_assoc($resultado);


    unlink('../imagenes/' . trim($propiedad['imagen']) );

   

        $query = "DELETE FROM propiedades WHERE id = '$id' ";
        $resultado = mysqli_query($db,$query);

        if($resultado){
            header('Location:/udemyphpcurso/BinesRaices/admin?codigo=3');
        }

    }
}

require_once '../includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrado de bienes raices</h1>
        <?php
        if( intval($codigo) === 1){?>
    
    <div class="alerta exito">Anuncio creado Correctamente</div>
    
    <?php }
    else if( intval($codigo) === 2){ ?>

    
    <div class="alerta exito">Anuncio Actualizado Correctamente</div>
    
    <?php }
    else if(intval($codigo) === 3){?>
    <div class="alerta exito">Anuncio Eliminado Correctamente</div>
    <?php }?>

        <a href ="/udemyphpcurso/BinesRaices/admin/propiedades/crear.php" class ="boton boton-verde">Nueva propiedad</a>
   <table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)){?>
        <tr>
            <td><?php echo $propiedad['id'];?></td>
            <td><?php echo $propiedad['titulo'];?></td>
            
            <td>
                <img src="../imagenes/<?php echo trim($propiedad['imagen']);?>" class="imagen-tabla" alt=" ">
            </td>
            
            <td><?php echo $propiedad['precio'];?></td>
            <td>
                <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                    <input type="submit" class="boton-rojo-block-eliminar" value="Eliminar"  >
                </form>
                <a href="/udemyphpcurso/BinesRaices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
   </table>
    </main>

    <?php
    //cerrar la conexion
mysqli_close($db);
incluirTemplate('footer');
?>