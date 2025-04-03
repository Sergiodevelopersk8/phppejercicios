<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo: </label>
                <input type="text"  id="titulo" name="propiedad[titulo]" placeholder="Titulo  propiedad" 
                value =  "<?php echo sant($propiedad->titulo); ?>" >
                
                <label for="precio">Precio: </label>
                <input type="number"  id="precio"  name="propiedad[precio]" placeholder="precio  propiedad"
                value =  "<?php echo sant($propiedad->precio); ?>" >
                
                <label for="imagen">Imagen: </label>
                <input type="file"  id="imagen"  accept="image/jpeg, image/png" name="propiedad[image]" >
                <?php if($propiedad->imagen){?>

                    <!-- ../../imagenes/ -->
<img src="../../public/imagenes/<?php echo $propiedad->imagen ?>" class="img-samll">

                <?php }?>

                <label for="descripcion">Descripcion</label>
                <textarea name="propiedad[descripcion]" id="descripcion"> <?php echo sant($propiedad->descripcion); ?> </textarea>
                
            </fieldset>
            
            <fieldset>
                <legend>Información Propiedad</legend>
                
                <label for="habitaciones">Habitaciones:</label>
                <input type="number"  id="habitaciones" name= "propiedad[habitaciones]" 
                placeholder="Numero de habitaciones" min="1" max="9" value =  "<?php echo sant($propiedad->habitaciones); ?>" >
                
                <label for="wc">Baños:</label>
                <input type="number"  id="wc" name="propiedad[wc]" placeholder="Numero de Baños" min="1" max="9"
                value =  "<?php echo sant($propiedad->wc); ?>">
             

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number"  id="estacionamient" name="propiedad[estacionamient]" placeholder="Numero de Estacionamiento"
                 min="1" max="9" value =  "<?php echo sant($propiedad->estacionamient); ?>">
            
            </fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">vendedor</label>
    <select name="propiedad[idVendedores]" id="vendedor">
        <option selected value="">--- Seleccione --- </option>
        <?php
        for($i = 0; $i < count($vendedores); $i++){ ?>
       
       
            <option 
            <?php echo $propiedad->idVendedores === $vendedores[$i]->idVendedores ? 'selected' : '' ?>
            value="<?php echo sant($vendedores[$i]->idVendedores)?>"> <?php echo sant($vendedores[$i]->nombre) . " ".sant($vendedores[$i]->apellido);?></option>

       <?php

        }
       
       ?>
    </select>
    </fieldset>
    <!-- $vendedorId === $vendedor['idVendedores'] si -> ? agrega -> 'selected' else -> : agrega -> ''; -->