<?php
// Incluir el archivo de configuración
include 'config.php';

// Mostrar el valor de las constantes
echo "<h1>Constantes definidas en config.php:</h1>";
echo "Base de datos: " . constant("BASE DE DATOS") . "<br>";
echo "Usuario: " .constant("USUARIO") . "<br>";
echo "Password: " .constant("PASSWORD") . "<br>";

// Mostrar el valor de las variables
echo "<h1>Variables definidas en config.php:</h1>";
echo "Correo del administrador: " . $adminEmail . "<br>";
echo "Correo de soporte: " . $supportEmail . "<br>";
echo "¿Modo mantenimiento activado?: " . ($maintenanceMode ? 'Sí' : 'No') . "<br>";
echo "Tipos de archivos permitidos: " . implode(', ', $allowedFileTypes) . "<br>";
?>
