<!DOCTYPE html>
<html>
  <head>
    <title>Tabla de multiplicar</title>
  </head>
  <body>

	<?php
	if (!isset($_REQUEST["numero"])) {
		// Si no tenemos un número pasado por POST, significa que estamos en la primera ejecución,
		// así que mostramos el formulario
		echo "<form action='for.php' method='POST'>
		Introduce un número:
		<input type='text' name='numero'>
		<br>
		<input type='submit'>
		</form>";
	}
	else {
		// Ya tenemos número pasado por GET. Vamos a calcular su tabla de multiplicar.
		$n = $_REQUEST["numero"];
		echo "<table border='1'>";
		echo "<tr><td colspan='5'>Tabla de multiplicar del número $n</td></tr>";
		echo "<tr>";
		for ($i = 1; $i <= 10; $i++) {
			if (($i-1) % 5 == 0) echo "</tr><tr>";
			echo "<td>$n x $i = " . $n * $i . "</td>";
		}
		echo "</tr>";
		echo "</table>";
	}
	?>
    <a href="for.php" class="back-link">Volver al menú de inicio</a>
  </body>
</html>
