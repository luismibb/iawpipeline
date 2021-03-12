<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author -grupo4
 */

require 'vendor/autoload.php';
require 'productos.php';
class ProductoTest extends \PHPUnit\Framework\TestCase {

    public function testInsertarProducto() 
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }



        $sqlPrueba = "select * from productos;";
        $resultado = $conn->query($sqlPrueba);


        $productoAntes = $resultado->num_rows;


        $productonuevo = new producto("8", "prueba", "1", "1");

        $productonuevo->insertarProducto($conn);

        $resultado = $conn->query($sqlPrueba);


        $productoDespues = $resultado->num_rows;


        $this->assertEquals($productoAntes + 1, $productoDespues, "El producto se ha insertado correctamente");


        $sqlPrueba = "select * from productos where cod like 'cod';";
        $resultado = $conn->query($sqlPrueba);


        $numeroFilas = $resultado->num_rows;

        $this->assertEquals(null, $numeroFilas, "El producto se inserta correctamente, 2a prueba, y no se repiten filas");

        $conn->close();
    }
    public function testbuscarProducto()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";


        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }




        $buscador = new producto("1","1","1","1");



        $resultado = $buscador->buscarProducto("1","ocod",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un producto con el codigo 1 y no estaba??");
    }
    public function testbuscarProductoPrecio()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }




        $buscador = new producto("1","1","1","1");




        $resultado = $buscador->buscarProducto("1","opre",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un precio de 1 y no estaba??");
    }
    public function testbuscarProductoStock()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }






        $buscador = new producto("1","1","1","1");




        $resultado = $buscador->buscarProducto("1","ostock",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un producto con el stock 1 y no estaba??");
    }
}