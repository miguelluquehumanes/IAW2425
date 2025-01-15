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
    $query = "SELECT * FROM usuarios LIMIT 1";
//Ejecución de la Query
    $resultado = mysqli_query($enlace, $query);
    print_r($resultado);
//Procesamiento de los resultados
    if (mysqli_num_rows ($resultado)>0){
        //Al menos tengo un registro
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "Nombre: " . $fila["nombre"] . "Apellido: " . $fila["apellidos"] . "Email: " . $fila["email"] . "<br>";
        }
    }
    else {
        echo "<p>No hubo resultados en la tabla</p>";
    }
//Cierre de la conexión
    mysqli_close($enlace);

?> 

