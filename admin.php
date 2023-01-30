<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';
require './lib/adminLib.php';

//Abrimos la página
head("Panel de administración");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Mostramos el navbar:
adminNavbar("active", "", "");

//-------------------- CONTENIDO DE LA PÁGINA --------------------------------------------------------------------------

//Verificamos que el usuario esté registrado y con una sesión válida. Si no es el caso, lo mandamos iniciar sesión.
if (!isset($_SESSION["logged"]))
    header("Location: /profile.php");


//Verificamos que el usuario es administrador
$sql = "SELECT * FROM `administradores` WHERE id_cliente=(SELECT id FROM clientes WHERE email='martin@justo.com')";
$result = mysqli_query($conn, $sql);
$log = mysqli_fetch_row($result);

if (!isset($log[0])) {
    samplePop("Debes ser administrador para poder visualizar este contenido.", "/logout.php", "Cerrar sesión");
} else {
    //El usuario existe y es admin
    headArticle();

    if(isset($_GET["userData"])){   //Se ha solicitado la información del usuario
        adminShowUserData($conn, $_GET["userData"]);
    }
    else if(isset($_GET["sent"])){
        //Marcamos el producto como enviado antes de mostrar
        $conn->query("UPDATE pedidos SET estado='Enviado' WHERE id={$_GET["sent"]}");

        header("Location: /admin.php");
    }
    else{
        adminListItem($conn);
    }









}





//----------------------En caso de que no se haya confirmado el borrado ------------------------------------------------


foother();
mysqli_close($conn);