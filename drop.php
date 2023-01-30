<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Eliminar");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Mostramos el navbar:
navbar("", "active", "");


//Obtención y limpieza de los datos del formulario:
if (isset($_GET['confirm']) && $_GET["confirm"] = 'true') {
    //Obtenemos la id
    $sql = "SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}'";
    $result = mysqli_query($conn, $sql);
    $log = mysqli_fetch_row($result);
    $id = $log[0];


    //Borramos los datos del usuario:
    $conn->query("DELETE FROM pedidos WHERE id_cliente='{$id}'");   //Pedidos
    $conn->query("DELETE FROM comentarios WHERE id_cliente='{$id}'");   //Comentarios
    $conn->query("DELETE FROM clientes WHERE email='{$_SESSION["logged"]}'"); //Cliente

    //Cierra la sesión
    echo "<script>window.location.href='logout.php';</script>";
    exit;
}

//----------------------En caso de que no se haya confirmado el borrado ------------------------------------------------

//Mensaje que se muestra
samplePop("¿Estás seguro de que quieres borrar tu perfil?", "/drop.php?confirm=true", "Sí, quiero eliminarlo");

foother();
mysqli_close($conn);