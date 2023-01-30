<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("winterShop");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Mostramos el navbar:
navbar("", "active", "");


// ------------ CONTENIDO DE LA PORTADA -------------------------------------------------------------------------------
headArticle();


//Llamada a usuarios
if (!isset($_SESSION["logged"]) || $_SESSION['carro']==0) {
    header("Location: /");  //Nos envía a la página de inicio.
} else {

    //Mostramos el botón del carrito:
    cartButton();

    //Mostramos los datos del usuario
    showUserData("Dirección de envío", $conn, false, false);

    //Mostramos las opciones de envío
    sendOption();

    //Mostramos los productos del pedido
    productListItem($conn, false, "Revisar productos", "SELECT * FROM carro WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}') ORDER BY fecha DESC", true);

    //Mostramos la opción de pagar
    productTotal("Subtotal", "<h3>{$_SESSION['carro']}€</h3>", "/martinsioBank", "Procesar pago", "", true);
}


foother();
mysqli_close($conn);