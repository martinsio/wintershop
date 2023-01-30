<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';
require './lib/messagesLib.php';

//Abrimos la página
head("Registro");

//Iniciamos la conexión con la BD
$conn = bdconnect();


//Obtención y limpieza de los datos del formulario:
$nombre = test_input($_POST['nombre']);
$apellido1 = test_input($_POST['apellido1']);
$apellido2 = test_input($_POST['apellido2']);
$direccion = test_input($_POST['direccion']);
$poblacion = test_input($_POST['poblacion']);
$cp = test_input($_POST['cp']);
$pais = test_input($_POST['pais']);
$email = test_input($_POST['email']);
$password = hash('sha256', test_input($_POST['password']));   //Solo almacenamos el hash de la contraseña


//Mostramos el navbar:
navbar("", "active", "");


//Si el usuario no está registrado en la base de datos
if (registerUser($conn, $nombre, $apellido1, $apellido2, $direccion, $email, $password, $poblacion, $cp, $pais)) {
    $result = "El usuario se ha registrado satisfactoriamente";
    $route = "/profile.php";
    $text = "Iniciar sesión";

} else {
    $result = 'No se ha podido registrar el usuario';
    $route = "/register.php";
    $text = "Intentar de nuevo";
}

//Mensaje que se muestra
samplePop($result, $route, $text);

foother();
mysqli_close($conn);