<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Inicio de sesión");

//Iniciamos la conexión con la BD
$conn = bdconnect();

//Obtención y limpieza de los datos del formulario:
$email = test_input($_POST['email']);
$password = hash('sha256', test_input($_POST['password']));

//Mostramos el navbar:
navbar("", "active", "");


if (isset($_SESSION["logged"])) {   //Si la sesión está iniciada, ofrecemos cerrarla.
    samplePop("Ya tienes iniciada una sesión. Para iniciar otra, primero debes cerrarla.", "/logout.php", "Cerrar sesión");
} else {
    //Comprobamos que el usuario existe
    if (valuser($conn, $email))
        samplePop("La dirección no se encuentra registrada.", "/profile.php", "Intentar de nuevo");
    else {
        //$passhashed = hash('sha256', $passwd);
        $sql = "SELECT * FROM clientes WHERE email='$email' and password='$password'";
        $result = mysqli_query($conn, $sql);
        $log = mysqli_fetch_row($result);

        if (!empty($log[0])) {  //Los datos son correctos

            //Creamos la sesión
            $_SESSION["logged"] = "$email";

            echo "<script>window.location.href='/';</script>"; //Nos envía a la página de perfil
            exit;   

        } else //La contraseña no coincide
            samplePop("Los datos introducidos no son correctos", "/profile.php", "Intentar de nuevo");
    }
}

foother();
mysqli_close($conn);