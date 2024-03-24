<?php

$codigo = $_GET['codigo'] ?? null;

require_once '../includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrado de bienes raices</h1>
        <?php
        if( intval($codigo) === 1){?>
    
    <div class="alerta exito">Anuncio creado correctamente</div>
    
    <?php }?>


        <a href ="/udemyphpcurso/BinesRaices/admin/propiedades/crear.php" class ="boton boton-verde">Nueva propiedad</a>
    </main>

    <?php
incluirTemplate('footer');
?>