<?php

require 'clientes.php';

// Variables
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";
$busqueda = $_POST["ftext"];
$tipoBusqueda = $_POST["opcion"];


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$clienteNuevo=new Cliente("test","test","test","test","test");
$clienteNuevo->buscarCliente($busqueda,$tipoBusqueda,$conn);



mysqli_close($conn);

?>