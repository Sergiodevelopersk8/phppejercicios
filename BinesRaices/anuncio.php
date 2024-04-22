<?php

require 'includes\config\database.php';

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id ){
    header('Location:anuncios.php');
}
//implementar base de datos

$db = conectarDB();

//consultar

$query = "SELECT * FROM propiedades WHERE id = $id";

//obtener resultado

$resultado = mysqli_query($db, $query); 
$propiedad = mysqli_fetch_assoc($resultado);

if(!$resultado ->num_rows ){
    header('Location:anuncios.php');
}


require_once 'includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

         <img loading="lazy" src="imagenes/<?php echo trim($propiedad['imagen']); ?>" alt="imagen de la propiedad">
   

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamient']; ?></p>
                </li>
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <?php echo $propiedad['descripcion']; ?>   </div>
    </main>

    <?php
mysqli_close($db);
incluirTemplate('footer');

?>