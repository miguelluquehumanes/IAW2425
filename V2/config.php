<?php
$servername = "localhost";
$username = "root";
$password = "usuario";
$bd = "BaseProyecto";
$enlace = mysqli_connect($servername, $username, $password, $bd);
if ($enlace->connect_error) {
    die("Conexión fallida: " . $enlace->connect_error);
}

if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

mysqli_set_charset($enlace, "utf8mb4");
?>
