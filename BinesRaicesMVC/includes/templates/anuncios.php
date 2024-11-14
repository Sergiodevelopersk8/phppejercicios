<?php
    

use App\Propiedad;



if($_SERVER['SCRIPT_NAME'] == '/udemyphpcurso/BinesRaices/anuncios.php'){
    $propiedades = Propiedad::all();
    
}
else{
    $propiedades = Propiedad::get(3);

}





?>
<div class="contenedor-anuncios">
    <?php
    for($i = 0; $i < count($propiedades); $i++)
    
    {
      
    ?>
      <div class="anuncio">
      <picture>
        
          <img  src="imagenes/<?php echo trim($propiedades[$i]->imagen); ?>" >
      </picture>

      <div class="contenido-anuncio">
          <h3><?php echo $propiedades[$i]->titulo; ?></h3>
          <p><?php echo $propiedades[$i]->descripcion; ?></p>
          <p class="precio"><?php echo $propiedades[$i]->precio; ?></p>

          <ul class="iconos-caracteristicas">
              <li>
                  <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                  <p><?php echo $propiedades[$i]->wc; ?></p>
              </li>
              <li>
                  <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                  <p><?php echo $propiedades[$i]->estacionamient; ?></p>
              </li>
              <li>
                  <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                  <p><?php echo $propiedades[$i]->habitaciones; ?></p>
              </li>
          </ul>

          <a href="anuncio.php?id=<?php echo $propiedades[$i]->id; ?>" class="boton-amarillo-block">
              Ver Propiedad
          </a>
      </div><!--.contenido-anuncio-->
  </div><!--anuncio-->
<?php 

}



?>
</div> <!--.contenedor-anuncios-->