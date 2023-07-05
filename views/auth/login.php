<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesion</h1>
<?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
        <form action="" method="POST" class="formulario" action="/login">
        <fieldset>
                <legend>Email y password</legend>
                
                <label for="Email">Email:</label>
                <input type="email" placeholder="Tu email" name="email" id="email" required>
                
                <label for="password">Passsword:</label>
                <input type="password" placeholder="Password" name="password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>