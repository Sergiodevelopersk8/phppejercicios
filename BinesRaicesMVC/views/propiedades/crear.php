<main class="contenedor seccion">
<h1>Crear propiedad</h1>

<?php
for($i=0; $i<count($errores);$i++){?>
    <div class="alerta error">
    <?php echo $errores[$i]; ?>
</div>
<?php
}
?>

<form class="formulario" method="POST" enctype="multipart/form-data">

    <?php include __DIR__ . '/formulario.php';?>
    
    <input type="submit" value="Crear Propiedad" class="boton boton-verde">

</form>
</main>