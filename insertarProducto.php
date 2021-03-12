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
    die("Error de conexión: ".$conn->connect_error);
}

// Datos del formulario
$fcod = $_POST["fcod"];
$fdesc = $_POST["fdesc"];
$fprecio = $_POST["fprecio"];
$fstock = $_POST["fstock"];

// Creación de nuevo objeto Producto
$productoNuevo = new Producto($fcod,$fdesc,$fprecio,$fstock);

// Inserción del Producto en la BBDD
$productoNuevo->insertarProducto($conn);

// Cierre de la conexión
$conn->close();

?>
