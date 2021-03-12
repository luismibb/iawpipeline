<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

require 'clientes.php';
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dni = $_POST["fdni"];
$nombre = $_POST["fnom"];
$apellidos = $_POST["fape"];
$fnac = $_POST["fdate"];
$email = $_POST["fmail"];
$clienteNuevo = new Cliente($dni,$nombre,$apellidos,$fnac,$email);
$clienteNuevo->darAlta($conn);
$conn->close();

?>
