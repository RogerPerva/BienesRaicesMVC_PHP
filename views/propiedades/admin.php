<main class="contenedor seccion dark-mode">
    <h1>Administrador de bienes raices</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) {  ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php
        }
    } ?>


    <a href="/propiedades/crear" class="boton boton-verde"> Nueva propiedad</a>
    <a href="vendedores/crear" class="boton boton-amarillo"> Nuevo(a) vendedor</a>
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($propiedades as $key => $value) : ?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->titulo; ?></td>
                    <td> <img src="../imagenes/<?php echo $value->imagen; ?>" class="imagen-tabla" alt="imagen_casa"></td>
                    <td>$<?php echo $value->precio; ?></td>
                    <td>
                        <form class="w-100" method="POST" action="/propiedades/eliminar">
                            <?php
                            //Vamos a crear un input hidden para que se manden datos de manera que el usuarion no pueda verlo
                            ?>
                            <input type="hidden" name="id" value="<?php echo $value->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $value->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                   
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vendedores as $key => $value):?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->nombre . " ". $value->apellido;?></td>
                    <td><?php echo $value->telefono; ?></td>
                    <td>
                        <form class="w-100" method="POST" action="vendedores/eliminar">
                            <?php
                            //Vamos a crear un input hidden para que se manden datos de manera que el usuarion no pueda verlo
                            ?>
                            <input type="hidden" name="id" value="<?php echo $value->id ?>" >
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $value->id?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

</main>