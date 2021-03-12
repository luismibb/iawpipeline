<?php

// Clases
class producto {

  //Estados
  private $fcod;
  private $fdesc;
  private $fprecio;
  private $fstock;
  private $tipoBusqueda;
  private $busqueda;

  //comportamientos
  function __construct($fcod,$fdesc,$fprecio,$fstock) {
    $this->fcod = $fcod;
    $this->fdesc = $fdesc;
    $this->fprecio = $fprecio;
    $this->fstock = $fstock;
  }

  function insertarProducto($conn){
    $sql = "INSERT INTO productos (cod, descripcion, precio, stock) VALUES ('".$this->fcod."', '".$this->fdesc."', '".$this->fprecio."', '".$this->fstock."');";
    if ($conn->query($sql) == true){
      echo "Nuevo registro insertado correctamente.";
    } else {
      echo "Error: ".$sql.$conn->error;
    }
  }

  function buscarProducto($busqueda,$tipoBusqueda,$conn){
    $sql = "SELECT * FROM productos WHERE ";
    switch ($tipoBusqueda) {
      case "ocod":
        $sql = $sql."cod = $busqueda;";
        break;
      case "odesc":
        $sql = $sql."descripcion like '%$busqueda%';";
        break;
      case "opre":
        $sql = $sql."precio <= $busqueda;";
	    break;
      case "ostock":
        $sql = $sql."stock <= $busqueda;";
        break;
      default:
        echo "Se ha producido un error durante la búsqueda.";
    }

    $resultado = $conn->query($sql);

    if ($conn->query($sql) == true) {
      // Consulta para realizar la busqueda en la base de datos
      if ($resultado->num_rows > 0) {
        // Salida de datos por cada fila
        while ($row = $resultado->fetch_assoc()) {
          echo "- Código: " . $row["cod"] . ", Descripción: " . $row["descripcion"] . ", Precio: " . $row["precio"] . ", Stock: " . $row["stock"] . "<br>";
        }
      } else {
        echo "No se han encontrado resultados";
      }
    } else {
      echo "Error: " . $sql . $conn->error;
    }
  }
}

?>