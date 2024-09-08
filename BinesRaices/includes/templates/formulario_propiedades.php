<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text"  id="titulo" name="titulo" placeholder="Titulo  propiedad" 
                value =  "<?php echo sant($propiedad->titulo); ?>" >
                
                <label for="precio">Precio: </label>
                <input type="number"  id="precio"  name="precio" placeholder="precio  propiedad"
                value =  "<?php echo sant($propiedad->precio); ?>" >
                
                <label for="imagen">Imagen: </label>
                <input type="file"  id="imagen"  accept="image/jpeg, image/png" name="image" >

                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion"> <?php echo sant($propiedad->descripcion); ?> </textarea>
                
            </fieldset>
            
            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number"  id="habitaciones" name= "habitaciones" 
                placeholder="Numero de habitaciones" min="1" max="9" value =  "<?php echo sant($propiedad->habitaciones); ?>" >
                
                <label for="wc">Baños:</label>
                <input type="number"  id="wc" name="wc" placeholder="Numero de Baños" min="1" max="9"
                value =  "<?php echo sant($propiedad->wc); ?>">
             

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number"  id="estacionamient" name="estacionamient" placeholder="Numero de Estacionamiento"
                 min="1" max="9" value =  "<?php echo sant($propiedad->estacionamient); ?>">
            
            </fieldset>
<fieldset>
    <legend>Vendedor</legend>
    
    </fieldset>
    <!-- $vendedorId === $vendedor['idVendedores'] si -> ? agrega -> 'selected' else -> : agrega -> ''; -->