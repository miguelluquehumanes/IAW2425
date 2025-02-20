<?php
$servername = "localhost";
$username = "root";
$password = "usuario";
$bd = "BaseProyecto";
$enlace = mysqli_connect($servername, $username, $password, $bd);

if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

mysqli_set_charset($enlace, "utf8mb4");
?>
