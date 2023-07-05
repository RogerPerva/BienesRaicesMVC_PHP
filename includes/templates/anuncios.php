<?php
 use Model\Propiedad;


 if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
     $propiedades = Propiedad::all();

 }else {

     $propiedades = Propiedad::get(3);
 }

?>
<div class="contenedor-anuncios"><!-- .contenido-anuncio -->
    <?php
        foreach($propiedades as $propiedad){
    ?>
            <div class="anuncio">
                
                    <img src="/imagenes/<?php echo $propiedad->imagen;?>" alt="anuncio" loading="lazy">
                
                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad->titulo; ?></h3>
                    <p><?php echo $propiedad->descripcion; ?></p>
                    <p class="precio"><?php echo $propiedad->precio; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img src="build/img/icono_wc.svg" alt="icono wc" loaging="lazy">
                            <p> <?php echo $propiedad->wc; ?> </p>
                        </li>
                        <li>
                            <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loaging="lazy">
                            <p> <?php echo $propiedad->estacionamiento; ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loaging="lazy">
                            <p> <?php echo $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>
                    <a href="/propiedad?id=<?php echo $propiedad->id;  ?>" class="boton-amarillo-block">
                        Ver propiedad
                    </a>
                </div> <!-- .contenido-anuncio -->
            </div><!--.anuncio-->
            <?php
        };
            ?>
        </div><!-- .contenedor de anuncios-->
