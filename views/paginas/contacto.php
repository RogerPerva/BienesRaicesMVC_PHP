 <main class="contenedor seccion">
     <h1>Contacto</h1>
     <?php
        if ($mensaje) { ?>
         echo <p class='alerta exito'> <?php echo $mensaje ?> </p>;
     <?php   }
        ?>
     <picture>
         <source srcset="build/img/destacada3.webp" type="imga/webp">
         <source srcset="build/img/destacada3.jpg" type="imga/jpeg">
         <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
     </picture>
     <h2> Llena el formulario</h2>

     <form class="formulario" action="/contacto" method="POST" ">
            <fieldset>
                <legend>Informacion personal</legend>
                
                <label for=" nombre">Nombre:</label>
         <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

         <label for="mensaje">Mensaje:</label>
         <textarea id="mensaje" name="contacto[mensaje]" required></textarea></textarea>
         </fieldset>

         <fieldset>
             <legend>Informacion sobre la propiedad</legend>

             <label for="opciones">Vende o compra:</label>
             <select id="opciones" name="contacto[tipo]" required>
                 <option value="" disabled selected>--Selecciona--</option>
                 <option value="Compra">Compra</option>
                 <option value="Vende">Vende</option>
             </select>

             <label for="presupuesto">Precio o presupuesto:</label>
             <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
         </fieldset>
         <fieldset>
             <legend>Informacion sobre la propiedad</legend>
             <p>Como desea ser contactado</p>
             <div class="forma-contacto">
                 <label for="contactar-telefono">Telefono</label>
                 <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" required>
                 <label for="contactar-email">Email</label>
                 <input name="contacto[contacto]" type="radio" value="email" id="contactar-email" required>
             </div>
             <div id="contacto">

             </div>

         </fieldset>

         <input type="submit" value="Enviar" class="boton-verde">
     </form>
 </main>