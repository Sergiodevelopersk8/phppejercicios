<?php

require_once '../../includes/app.php';
use App\Vendedor;

estaAutenticado();


$id = $_GET['idVendedores'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location:/udemyphpcurso/BinesRaices/admin/');
}

//obtener el arreglo de la base de datos
$vendedor = Vendedor::find($id);




$errores = Vendedor::getErrores();


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $args = $_POST['vendedor'];

    //sincronizar objeto en memoria
    $vendedor->sincronizar($args);

    //validar
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }


}


incluirTemplate('header');


?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>
        
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
            <?php include '../../includes/templates/formulario_vendedores.php';?>
<input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');

/*

*/

?>

