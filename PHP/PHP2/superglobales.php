<?php
// Obtener la dirección IP del usuario
$ipUsuario = $_SERVER['REMOTE_ADDR'];

// Obtener el navegador que utiliza el usuario
$navegadorUsuario = $_SERVER['HTTP_USER_AGENT'];

// Obtener la página previa que refirió al usuario (si existe)
$paginaReferida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No disponible';

// Mostrar los datos al usuario
echo "<h1>Información de conexión</h1>";
echo "<p><strong>Dirección IP:</strong> $ipUsuario</p>";
echo "<p><strong>Navegador:</strong> $navegadorUsuario</p>";
echo "<p><strong>Página de referencia:</strong> $paginaReferida</p>";
?>
