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


//Mostramos el navbar:
navbar("", "active", "");


//Si el usuario no está registrado en la base de datos
if (isset($_SESSION["logged"])){
    $conn->query("UPDATE clientes SET nombre='{$nombre}', apellido1='{$apellido1}', apellido2='{$apellido2}', direccion='{$direccion}', poblacion='{$poblacion}', cp='{$cp}', pais='{$pais}' WHERE email='{$_SESSION["logged"]}'");
}

//Mensaje que se muestra
samplePop("Los datos se han actualizado.", "/profile.php", "Ver perfil");

foother();
mysqli_close($conn);