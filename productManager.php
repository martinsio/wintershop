<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';
require './lib/adminLib.php';

//Abrimos la página
head("Gestión de productos");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Mostramos el navbar:
adminNavbar("", "", "active"); //----------------------------------------

headArticle();

//-------------------- CONTENIDO DE LA PÁGINA --------------------------------------------------------------------------

//Verificamos que el usuario esté registrado y con una sesión válida. Si no es el caso, lo mandamos iniciar sesión.
if (!isset($_SESSION["logged"]))
    header("Location: /profile.php");


//Verificamos que el usuario es administrador
$sql = "SELECT * FROM `administradores` WHERE id_cliente=(SELECT id FROM clientes WHERE email='martin@justo.com')";
$result = mysqli_query($conn, $sql);
$log = mysqli_fetch_row($result);

if (isset($log[2]) && $log[2] = 1) {  //Tiene permiso para editar productos y categorías

    //Eliminar productos (realmente solo los deshabilita)
    if(isset($_GET["drop"])){
        $conn->query("UPDATE productos SET disabled=1 WHERE id={$_GET["drop"]}");
    }

    //Restaurar producto
    if(isset($_GET["undrop"])){
        $conn->query("UPDATE productos SET disabled=0 WHERE id={$_GET["undrop"]}");
    }

    //Eliminar categoría (realmente solo los deshabilita)
    if(isset($_GET["dropCat"])){
        $conn->query("UPDATE categorias SET disabled=1 WHERE id={$_GET["dropCat"]}");   //Desactivamos la categoría
        $conn->query("UPDATE productos SET disabled=1 WHERE idCategoria={$_GET["dropCat"]}");   //Desactivamos todos sus productos asociados
    }

    //Restaurar categoría
    if(isset($_GET["undropCat"])){
        $conn->query("UPDATE categorias SET disabled=0 WHERE id={$_GET["undropCat"]}");  //Reactivamos la categoría
        $conn->query("UPDATE productos SET disabled=0 WHERE idCategoria={$_GET["undropCat"]}");   //Reactivamos todos sus productos asociados
    }

    adminListProducts($conn);
    adminListCategories($conn);


} else { //No tiene permisos suficientes
    samplePop("No tienes permisos suficientes para acceder a esta sección. Inicia sesión con otra cuenta..", "/logout.php", "Cerrar sesión");







}


//----------------------En caso de que no se haya confirmado el borrado ------------------------------------------------


foother();
mysqli_close($conn);