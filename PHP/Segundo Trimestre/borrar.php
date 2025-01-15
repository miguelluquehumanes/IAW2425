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
    $query = "DELETE FROM usuarios WHERE id=0";
//Ejecución de la Query
    $resultado = mysqli_query($enlace, $query);
//Procesamiento de los resultados
    if ($resultado) {
        echo "Registro borrado correctamente";
    }
    else {
        echo "Error en el borrado";
    }
//Cierre de la conexión
    mysqli_close($enlace);

?> 