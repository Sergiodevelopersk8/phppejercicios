<?php

require_once '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor();


$errores = Vendedor::getErrores();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $vendedor = new Vendedor($_POST['vendedor']);

//validar campos vacios 

$errores = $vendedor->validar();

if(empty($errores)){
    $vendedor->guardar();
}


}


incluirTemplate('header');


?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        
        <a href ="/udemyphpcurso/BinesRaices/admin" class ="boton boton-verde">Volver</a>
       

<?php
for($i=0; $i<count($errores);$i++){?>
    <div class="alerta error">
    <?php echo $errores[$i]; ?>
</div>
<?php
}
?>

        <form class="formulario" method="POST"  action="/udemyphpcurso/BinesRaices/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario_vendedores_crear.php';?>
<input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');

/*

*/

?>

