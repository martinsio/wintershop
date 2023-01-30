<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Mi Cuenta");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Obtenemos los datos
$idProducto = test_input($_GET['id']);

if(isset($_SESSION["logged"])) { //Si la sesión se encuentra iniciada podemos proceder al borrado

    //Obtenemos el id del cliente:
    $sqlId="SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}'";
    $resultado = mysqli_query($conn, $sqlId);
    $idCliente = mysqli_fetch_row($resultado);


    $conn->query("DELETE FROM carro WHERE id_producto={$idProducto} AND id_cliente={$idCliente[0]}");
}


mysqli_close($conn);

//Redirecciona automaticamente al carro
echo "<script>window.location.href='cart.php';</script>";
    exit;



