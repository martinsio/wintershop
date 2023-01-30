<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("winterShop");

//Iniciamos la conexión con la BD
$conn = bdconnect();


//Mostramos el navbar:
navbar("", "", "active");


//----------------- CONTENIDO DE LA PÁGINA ----------------------------------------------------------------------------
headArticle();

if (!isset($_SESSION["logged"])  ||  $_SESSION['carro'] == 0){ //Nos envía a la página de inicio.
    echo "<script>window.location.href='/';</script>";
    exit;
}

//Mostramos el botón del carrito:
cartButton();

//Seleccionamos todos los prodctos que tenemos en el carro y los añadimos a pedidos. Una vez hecho eso vaciamos el carro y su session con el precio
$sql = "SELECT id_cliente, id_producto, cantidad FROM `carro` WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}')";

if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        //Insertamos los datos
        $conn->query("INSERT INTO `pedidos` (`id`, `id_cliente`, `id_producto`, `cantidad`, `fecha`, `estado`) VALUES (NULL, '{$row["id_cliente"]}', '{$row["id_producto"]}', '{$row["cantidad"]}', current_timestamp(), 'No enviado')");
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}



echo
"<div class=\"best-features\">
      <div class=\"container\">
      <h3 id='titleProduct'>El pedido ha sido procesado</h3>
        <div class=\"row\">
          <div class=\"col-md-12\">

          </div>

            <div class=\"left-content\" id='userDataBox'>
              <ul>
                <li id='confirmationSub'>A partir de ahora puedes realizar el seguimiento desde tu perfil.</li>
              </ul>
              <a href=\"/profile.php\" class=\"filled-button\">Ir a mi perfil</a>

          </div>
          <div class=\"col-md-6\">

          </div>
        </div>
      </div>
    </div>";



//Mostramos los productos del pedido
productListItem($conn, false, "Detalles del pedido","SELECT * FROM carro WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}')" ,false );


//Vaciamos el carro
$conn->query("DELETE FROM carro WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}')");

//Ponemos a 0 el total del pedido
$_SESSION['carro'] = 0;


// ------------------------ CIERRE DE LA PÁGINA -------------------------------------------------------------------
foother();
mysqli_close($conn);