<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097508";
$password = "iUgOhGt?";

try {
  $conn = new PDO("mysql:host=$servername;dbname=thsi_38097508_bdprueba", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Conectado exitosamente 3";
} catch(PDOException $e) {
  echo "Conexión fallida: " . $e->getMessage();
}
?> 