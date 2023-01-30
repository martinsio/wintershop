<?php

// --------------------- MÉTODOS QUE INTERACTUAN DIRECTAMENTE CON LA BASE DE DATOS ---------------------------------//
//Conectar a BD:
function bdconnect()
{
    $servername = "localhost";
    $username = "bdUsername";
    $password = "bdPassword";
    $database = "bdName";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    return $conn;
}


function registerUser($conn, $nombre, $apellido1, $apellido2, $direccion, $email, $password, $poblacion, $cp, $pais)
{
    if (!valuser($conn, $email))    //User can't be registred
        return false;
    else {
        $sql = "INSERT INTO clientes (nombre, apellido1, apellido2, email, password, direccion, poblacion, cp, pais) VALUES ('$nombre', '$apellido1', '$apellido2','$email','$password','$direccion', '$poblacion', '$cp', '$pais')";

        //Returns True if the insert was done
        return mysqli_query($conn, $sql);
    }
}

//Returns true if the mail can be registred
function valuser($conn, $email)
{
    //Comprobamos que el usuario existe
    $resultado = mysqli_query($conn, "SELECT email FROM clientes WHERE email = '$email'");
    $fila = mysqli_fetch_row($resultado);

    return empty($fila[0]);
}

//filtrado de datos
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Obtener datos de un usuario a partir de la ID:
function userData($id, $conn){
    $sql = "SELECT nombre, apellido1, apellido2 FROM clientes WHERE id={$id}";
    $result = mysqli_query($conn, $sql);
    $log = mysqli_fetch_row($result);

    //Devolvemos los datos
    return "$log[0] $log[1] $log[2]";
}

//Devuelve el número de comentarios (como texto) que tiene un producto dada su id:
function numComments($id, $conn){

    $sql = "SELECT COUNT(id) FROM comentarios WHERE id_producto={$id}";
    $result = mysqli_query($conn, $sql);
    $log = mysqli_fetch_row($result);

    return "$log[0]";

}