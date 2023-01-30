<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("winterShop");

//Iniciamos la conexión con la BD
$conn = bdconnect();



//Mostramos el navbar:
navbar("active", "", "");


// ------------ CONTENIDO DE LA PORTADA -------------------------------------------------------------------------------
//Baner personalizado para la página de inicio
initialBanner();

//Mostramos el botón del carrito:
if (isset($_SESSION["logged"])) cartButton();



//Primer bloque de productos - Recientemente añadidos
productListOpener("Recién llegados");

$sql = "SELECT * FROM productos WHERE disabled=0 ORDER BY fechaAlta DESC LIMIT 6";


if ($result = mysqli_query($conn, $sql)) {
    /* obtener array asociativo */
    while ($row = mysqli_fetch_assoc($result)) {
        productItem($row["nombre"], $row["precio"], $row["descripcion"], numComments($row["id"],$conn), $row["id"]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}
productListCloser();

//Muestra la oferta del día
specialOffer();


//Segundo bloque de productos - Ofertas
productListOpener("Rebajados");
$sql = "SELECT * FROM productos WHERE oferta > 0 AND disabled=0 ORDER BY fechaAlta DESC LIMIT 6";


if ($result = mysqli_query($conn, $sql)) {
    /* obtener array asociativo */
    while ($row = mysqli_fetch_assoc($result)) {
        productItem($row["nombre"], $row["precio"], $row["descripcion"], numComments($row["id"],$conn), $row["id"]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}
productListCloser();

//Llamada a usuarios
if (!isset($_SESSION["logged"])) {
    callToAction("¿Nos acabas de conocer? ¡No te pierdas nada!", "Registrate ahora para estar al corriente de todas las novedades.", "/register.php", "Registro", "");
} else {
    callToAction("¿Te gusta mi tienda?", "Puntúame con un 10 para alegrarme el día :D", "https://github.com/martinsio/wintershop", "Puntuar", "target=\"_blank\"");
}


foother();
mysqli_close($conn);