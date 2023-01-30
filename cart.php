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
if (!isset($_SESSION["logged"])) {
    header("Location: /profile.php");  //Nos envía a la página de inicio.
} else {

    //Obtenemos el precio total del carrito
    $total = 0;
    $sql = "SELECT cantidad, id_producto FROM carro WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}')";

    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {

            //Obtenemos el precio del producto
            $sql_precio = "SELECT precio FROM productos WHERE id={$row["id_producto"]}";
            $resultado = mysqli_query($conn, $sql_precio);
            $log = mysqli_fetch_row($resultado);

            $total += intval($row["cantidad"]) * $log[0];
        }
        /* liberar el conjunto de resultados */
        mysqli_free_result($result);
    }


    productListItem($conn,true, "Cesta de la compra", "SELECT * FROM carro WHERE id_cliente=(SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}') ORDER BY fecha DESC", true);
    $_SESSION['carro']=$total;  //Nos guarda el valor para otras páginas

    productTotal("Subtotal", "<h3>{$total}€</h3>", "/order.php", "Tramitar pedido", "", $total>0);

}


foother();
mysqli_close($conn);