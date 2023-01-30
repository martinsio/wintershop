<?php
require './lib/defaultLib.php';
require './lib/bdconnection.php';

//Abrimos la página
head("Mi Cuenta");

//Mostramos el navbar:
navbar("","active", "");

session_destroy();  //Cierra la sesión

echo "<script>window.location.href='/';</script>"; //Nos envía a la página de inicio
    exit;

foother();