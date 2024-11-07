<?php
require_once '../includes/app.php';
estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//implementar metodo para obtener todas las propieades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();


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

        $tipo = $_POST['tipo'];

        if(validarTipoContenido($tipo)){
            //compara lo que vamos a eliminar
            if($tipo == 'vendedor'){
                
                $vendedores = Vendedor::findvendedor($id);
                $vendedores->eliminarvendedor();
            }   
            
            else if($tipo == 'propiedad'){
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            }

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
   
    <h2>Propiedades</h2>
   
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
        <?php foreach($propiedades as $propiedad){?>
        <tr>
            <td><?php echo $propiedad->id;?></td>
            <td><?php echo $propiedad->titulo;?></td>
            
            <td>
                <img src="../imagenes/<?php echo trim($propiedad->imagen);?>" class="imagen-tabla" alt=" ">
            </td>
            
            <td><?php echo $propiedad->precio;?></td>
            <td>
                <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                    <input type="hidden" name="tipo" value="propiedad">
                    <input type="submit" class="boton-rojo-block-eliminar" value="Eliminar"  >
                </form>
                <a href="/udemyphpcurso/BinesRaices/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
   </table>
  
<h2>Vendedores</h2>
<table class="propiedades">


    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($vendedores); $i++){?>
        <tr>
            <td><?php echo $vendedores[$i]->idVendedores;?></td>
            <td><?php echo $vendedores[$i]->nombre. " " . $vendedores[$i]->apellido;?></td>
            <td><?php echo $vendedores[$i]->telefono;?></td>
            
            
            
          
            <td>
                <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $vendedores[$i]->idVendedores; ?>">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="submit" class="boton-rojo-block-eliminar" value="Eliminar"  >
                </form>
                <a href="/udemyphpcurso/BinesRaices/admin/vendedores/actualizar.php?id=<?php echo $vendedores[$i]->idVendedores; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
   </table>

</main>

    <?php

incluirTemplate('footer');
?>