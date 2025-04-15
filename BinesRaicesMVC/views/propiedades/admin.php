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
        <a href ="/vendedor/crear" class ="boton boton-amarillo">Nuevo(a) Vendedor</a>
   
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
                <form method="POST" class="w-100" action="/propiedades/eliminar">
                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                    <input type="hidden" name="tipo" value="propiedad">
                    <input type="submit" class="boton-rojo-block-eliminar" value="Eliminar"  >
                </form>
                <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" 
                class="boton-amarillo-block">Actualizar</a>
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
                <form method="POST" class="w-100" action="/vendedor/eliminar">
                    <input type="hidden" name="id" value="<?php echo $vendedores[$i]->idVendedores; ?>">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="submit" class="boton-rojo-block-eliminar" value="Eliminar"  >
                </form>
                <a href="/vendedor/actualizar?idVendedores=<?php echo $vendedores[$i]->idVendedores; ?>" class="boton-amarillo-block">Actualizar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
   </table>
</main>