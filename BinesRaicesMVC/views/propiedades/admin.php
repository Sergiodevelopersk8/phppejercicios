<main class="contenedor seccion">
        <h1>Administrado de bienes raices</h1>
       <?php
       if($codigo){

 
       $mensaje = mostrarNotificacion(intval($codigo));
       if($mensaje){?>
<p class="exito"><?php echo sant($mensaje);?></p>
<?php
    }
 }
?>


        <a href ="/propiedades/crear" class ="boton boton-verde">Nueva propiedad</a>
        <a href ="/udemyphpcurso/BinesRaices/admin/vendedores/crear.php" class ="boton boton-amarillo">Nuevo(a) Vendedor</a>
   
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
</main>