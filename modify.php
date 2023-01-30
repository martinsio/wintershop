<?php
require './lib/defaultLib.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Mi Cuenta");


//Mostramos el navbar:
navbar("","active", "");


if(isset($_SESSION["logged"])) { //Si la sesión se encuentra iniciada mostramos los datos del usuario y sus pedidos
    samplePop("Ya tienes iniciada una sesión. Para iniciar otra, primero debes cerrarla.", "/logout.php", "Cerrar sesión");
}

else{   //En caso contrario, se puede registrar o inicar sesión.
    echo '
        <div class="services" id="logServices">
      <div class="container">
        <div class="row">
          <div class="col-md-4" id="logReg">
            <div class="service-item">
              <div class="down-content">
                <h4>Formulario de registro</h4>
                    <form method="POST" action="sendregister.php" class="login-form">
                        <label for="nombre">
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                        </label>
                        <br>
                        <label for="apellido1">
                            <input type="text" name="apellido1" class="form-control" id="apellido1" placeholder="Primer apellido" required>
                        </label>
                        <br>
                        <label for="apellido2">
                            <input type="text" name="apellido2" class="form-control" id="apellido2" placeholder="Segundo apellido" required>
                        </label>
                        <br>
                        <label for="direccion">
                            <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" required>
                        </label>
                        <br>
                        <label for="poblacion">
                            <input type="text" name="poblacion" class="form-control" id="poblacion" placeholder="Población" required>
                        </label>
                        <br>
                        <label for="cp">
                            <input type="text" name="cp" class="form-control" id="cp" placeholder="Código postal" required>
                        </label>
                        <br>
                        <label for="pais">
                            <input type="text" name="pais" class="form-control" id="pais" placeholder="País" required>
                        </label>
                        <br>
                        <label for="email">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                        </label>
                        <br>
                        <label for="password">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </label>
                        <br>
                        <input type="submit" value="¡Regístrame!"id="logButtons">
                        </br></br>
                        <p>¿Ya tienes cuenta? <a href="profile.php">Inicia sesión</a></p>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

}















foother();