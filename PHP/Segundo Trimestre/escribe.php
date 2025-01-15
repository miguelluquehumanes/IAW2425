<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097508";
$password = "iUgOhGt?";
$bd = "thsi_38097508_bdprueba";
$enlace = mysqli_connect ($servername, $username, $password, $bd);
if (!$enlace){
    die("Ocurrió un problema con la conexión: " . mysqli_connect_error());
}

// Construcción de la Query
    $query = "INSERT INTO usuarios(nombre, apellidos, email) VALUES ('Miguel', 'Luque Humanes', 'miguel@gmail.com')";
//Ejecución de la Query
    $resultado = mysqli_query($enlace, $query);
//Procesamiento de los resultados
    if ($resultado) {
        echo "Registro insertado correctamente";
    }
    else {
        echo "Error en la inserción";
    }
//Cierre de la conexión
    mysqli_close($enlace);

?> 