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


// ------------ CONTENIDO DE LA PORTADA -------------------------------------------------------------------------------
headArticle();

// ----------- SELECTOR DE CATEGORÍAS ---------------------------------------------------------------------------------
categoriesPageOpener();


//Mostramos el botón del carrito:
if (isset($_SESSION["logged"])) cartButton();


if (!isset($_GET["id"]))
    echo"<li class=\"active\">Todos</li>";
else
    echo"<li><a href='products.php' id='productLink'>Todos</a></li>";


$sql = "SELECT id, nombre FROM `categorias` ORDER BY nombre ASC";

if ($result = mysqli_query($conn, $sql)) {
    /* obtener array asociativo */
    while ($row = mysqli_fetch_assoc($result)) {

        //Verifica si la categoría es la que está marcada
        if(isset($_GET["id"]) && $_GET["id"]==$row["id"])
            echo"<li class=\"active\">{$row["nombre"]}</li>";
        else
            echo"<li><a href='products.php?id={$row["id"]}' id='productLink'>{$row["nombre"]}</a></li>";

    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}

echo"</ul></div></div>";
//---------------------------------------------------------------------------------------------------------------------



// ------------ VISUALIZACIÓN DE LOS PRODUCTOS ------------------------------------------------------------------------

//Abrimos la sección:
echo "<div class=\"row\"></div>";


//Muestra todos los productos o los de una categoría concreta según corresponda
if (!isset($_GET["id"]))
    $sql = "SELECT * FROM productos ORDER BY fechaAlta DESC";
else
    $sql = "SELECT * FROM productos WHERE idCategoria={$_GET["id"]} ORDER BY fechaAlta";


if ($result = mysqli_query($conn, $sql)) {
    /* obtener array asociativo */
    while ($row = mysqli_fetch_assoc($result)) {
        productItem($row["nombre"], $row["precio"], $row["descripcion"], numComments($row["id"],$conn), $row["id"]);
    }
    /* liberar el conjunto de resultados */
    mysqli_free_result($result);
}

//Cerramos la sección
echo"</div>";

//categoriesPageProducts();




















foother();
mysqli_close($conn);