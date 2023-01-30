<?php
require './lib/defaultLib.php';
require './lib/messagesLib.php';
require './lib/bdconnection.php';


//Abrimos la página
head("Mi Cuenta");

//Mostramos el navbar:
navbar("", "active", "");

if (!isset($_SESSION["logged"]))
{
    echo "<script>window.location.href='/';</script>";
    exit;
}
    

//Mostramos el botón del carrito:
cartButton();

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Obtenemos los datos del usuario:
$sql = "SELECT nombre, apellido1, apellido2, direccion, poblacion, cp, pais FROM clientes WHERE email='{$_SESSION["logged"]}'";
$result = mysqli_query($conn, $sql);
$log = mysqli_fetch_row($result);


//Mostramos los datos en el formulario
echo "
    <div class=\"services\" id=\"logServices\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-4\" id=\"logReg\">
        <div class=\"service-item\">
          <div class=\"down-content\">
            <h4>Modifica tus datos</h4>
                <form method=\"POST\" action=\"sendDataUpdate.php\" class=\"login-form\">
                    <label for=\"nombre\">
                        <input type=\"text\" name=\"nombre\" class=\"form-control\" id=\"nombre\" placeholder=\"Nombre\" value=\"{$log[0]}\" required>
                    </label>
                    <br>
                    <label for=\"apellido1\">
                        <input type=\"text\" name=\"apellido1\" class=\"form-control\" id=\"apellido1\" placeholder=\"Primer apellido\" value=\"{$log[1]}\" required>
                    </label>
                    <br>
                    <label for=\"apellido2\">
                        <input type=\"text\" name=\"apellido2\" class=\"form-control\" id=\"apellido2\" placeholder=\"Segundo apellido\" value=\"{$log[2]}\" required>
                    </label>
                    <br>
                    <label for=\"direccion\">
                        <input type=\"text\" name=\"direccion\" class=\"form-control\" id=\"direccion\" placeholder=\"Dirección\" value=\"{$log[3]}\" required>
                    </label>
                    <br>
                    <label for=\"poblacion\">
                        <input type=\"text\" name=\"poblacion\" class=\"form-control\" id=\"poblacion\" placeholder=\"Población\" value=\"{$log[4]}\" required>
                    </label>
                    <br>
                    <label for=\"cp\">
                        <input type=\"text\" name=\"cp\" class=\"form-control\" id=\"cp\" placeholder=\"Código postal\" value=\"{$log[5]}\" required>
                    </label>
                    <br>
                    <label for=\"pais\">
                        <input type=\"text\" name=\"pais\" class=\"form-control\" id=\"pais\" placeholder=\"País\" value=\"{$log[6]}\" required>
                    </label>
                    <br>
                    <input type=\"submit\" value=\"Actualizar datos\"id=\"logButtons\">
                </form>
                <br><a id=\"nota\"><b>*Nota:</b> No se permite modificar los datos de acceso.<a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>";




foother();