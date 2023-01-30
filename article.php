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

//Obtenemos la id del artículo
$id = $_GET["id"];


//----------------- CONTENIDO DE LA PÁGINA ----------------------------------------------------------------------------
headArticle();

//Mostramos el botón del carrito:
if (isset($_SESSION["logged"])) cartButton();

$sql = "SELECT nombre, marca, descripcion, precio FROM productos WHERE id={$id}";
$result = mysqli_query($conn, $sql);
$log = mysqli_fetch_row($result);

//Mostramos los datos del producto
productPage($id, $log[1], $log[0], $log[2], $log[3]);



// ------------- PRODUCTOS RELACIONADOS ------------------------------------------------------------//
productListOpener("Productos relacionados"); //Misma categoría, diferente ID

$sql = "SELECT * FROM productos WHERE idCategoria=(SELECT idCategoria FROM productos WHERE id={$id}) AND NOT id={$id} ORDER BY fechaAlta DESC LIMIT 3";


if ($result = mysqli_query($conn, $sql)) {
    /* obtener array asociativo */
    while ($row = mysqli_fetch_assoc($result)) {
        productItem($row["nombre"], $row["precio"], $row["descripcion"], numComments($row["id"], $conn), $row["id"]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}


//Cerramos la sección de productos relacionados
productListCloser();


// --------------------- COMENTARIOS DE LOS CLIENTES -----------------------------------------------//
//*Solo se muestra si existen comentarios

if(numComments($id, $conn)){
    commentsOpener();

    $sql = "SELECT  id_cliente, comentario, fecha FROM comentarios WHERE id_producto={$id} ORDER BY fecha ASC ";

    if ($result = mysqli_query($conn, $sql)) {
        /* obtener array asociativo */
        while ($row = mysqli_fetch_assoc($result)) {
            $userData = userData($row["id_cliente"], $conn);
            commentsShow($userData, $row["comentario"], $row["fecha"]);
        }
        /* liberar el conjunto de resultados */
        mysqli_free_result($result);
    }
    commentsCloser();
}



// ------------------------ CIERRE DE LA PÁGINA -------------------------------------------------------------------
foother();
mysqli_close($conn);