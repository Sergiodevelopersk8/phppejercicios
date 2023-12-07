<?php
require_once '../../includes/funciones.php';
incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href ="/udemyphpcurso/BinesRaices/admin/index.php" class ="boton boton-verde">Volver</a>
        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text"  id="titulo" placeholder="Titulo  propiedad">
                
                <label for="precio">Precio: </label>
                <input type="number"  id="precio" placeholder="precio  propiedad">
                
                <label for="imagen">Imagen: </label>
                <input type="file"  id="imagen" accept="image/jpeg, image/png" >

                <label for="descripcion">Descripcion</label>
                <textarea name="" id="descripcion"></textarea>
            
            
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number"  id="habitaciones" placeholder="Numero de habitaciones" min="1" max="9">
            
                <label for="wc">Baños:</label>
                <input type="number"  id="wc" placeholder="Numero de Baños" min="1" max="9">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number"  id="estacionamiento" placeholder="Numero de Estacionamiento" min="1" max="9">
            
            </fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <select >
        <option value="1">Sergio</option>
        <option value="2">Kiernan</option>
    </select>
</fieldset>
<input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php
incluirTemplate('footer');
?>