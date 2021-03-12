<?php

//Llamada a la clase Producto
require 'productos.php';

// Variables
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";

// Establecer conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Datos del formulario
$busqueda = $_POST["ftext"];
$tipoBusqueda = $_POST["opcion"];

// Creación de nuevo objeto Producto
$productoExistente = new Producto("prueba","prueba","prueba","prueba");

// Búsqueda del Producto en la BBDD
$productoExistente->buscarProducto($busqueda,$tipoBusqueda,$conn);

// Cierre de la conexión
$conn->close();

?>
