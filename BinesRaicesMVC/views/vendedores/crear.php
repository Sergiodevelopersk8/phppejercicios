<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        
        <a href ="/admin" class ="boton boton-verde">Volver</a>
       

        <?php
for($i=0; $i<count($errores);$i++){?>
    <div class="alerta error">
    <?php echo $errores[$i]; ?>
</div>
<?php
}
?>

        <form class="formulario" method="POST"  action="/vendedor/crear">
           <?php include 'formulario.php';  ?>
        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>