<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097508";
$password = "iUgOhGt?";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?> 