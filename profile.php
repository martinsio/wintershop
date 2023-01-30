<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Mi Cuenta");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Mostramos el navbar:
navbar("", "active", "");



//------------------------------- CONTENIDO -------------------------------------

if (isset($_SESSION["logged"])) { //Si la sesión se encuentra iniciada mostramos los datos del usuario y sus pedidos
    //Mostramos el head
    headMulti("profile-heading", "");


    //Datos del usuario
    showUserData("Tus datos", $conn, true, true);

    productListItem($conn, false, "Tus pedidos", "SELECT * FROM `pedidos` WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}') ORDER BY fecha DESC", false);

    //Mostramos el botón del carrito
    cartButton();


} else {   //En caso contrario, se puede registrar o inicar sesión.
    echo '
     <div class="services" id="logServices">
      <div class="container">
        <div class="row">
          <div class="col-md-4" id="logReg">
            <div class="service-item">
              <div class="down-content">
                <h4>Iniciar sesión</h4>
                <form method="POST" action="sendlogin.php" class="login-form">
                    <label for="email">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                    </label>
                    <br>
                    <label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                    </label>
                    <br>
                    <input type="submit" value="Acceder" id="logButtons">
                 </form>
              </div>
            </div>
          </div>
          <div class="col-md-4" id="logReg">
            <div class="service-item">
              <div class="down-content">
                <h4>¿Eres nuevo?</h4>
                <a href="register.php" class="filled-button">Crear cuenta</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

}


foother();
