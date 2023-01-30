<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("winterShop");

//Iniciamos la conexión con la BD
$conn = bdconnect();


//Obtenemos los datos a añadir
$productId = test_input($_POST["idBox"]);
$amount = test_input($_POST["amount"]);

//Obtenemos el id del cliente:
$sqlId="SELECT id FROM clientes WHERE email='{$_SESSION["logged"]}'";
$resultado = mysqli_query($conn, $sqlId);
$idCliente = mysqli_fetch_row($resultado);




//Comprobamos si el producto ya se encuentra en el carrito:
$sql = "SELECT cantidad FROM carro WHERE id_cliente={$idCliente[0]} AND id_producto={$productId}";
$result = mysqli_query($conn, $sql);
$log = mysqli_fetch_row($result);


//Si el producto ya está en el carrito
if (!empty($log[0])) {
    $nuevaCantidad=intval($log[0])+intval($amount);
    echo"<a>LA NUEVA CANTIDAD ES {$nuevaCantidad}</a>";
    $conn->query("UPDATE carro SET cantidad = {$nuevaCantidad} WHERE id_producto={$productId} AND id_cliente={$idCliente[0]}");

}
else{//si no está ya en el carrito lo añadimos
    $conn->query("INSERT INTO `carro` (`id`, `id_cliente`, `id_producto`, `fecha`, `cantidad`) VALUES (NULL, {$idCliente[0]}, {$productId}, current_timestamp(), {$amount})");
}

mysqli_close($conn);

//Redirecciona automaticamente al carro
echo "<script>window.location.href='/cart.php';</script>";
    exit;
