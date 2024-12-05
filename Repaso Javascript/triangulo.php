<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generador de Asteriscos</title>
  <style>
    .output p {
      font-family: monospace;
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <h1>Generador de Párrafos con Asteriscos</h1>
  <p>Introduce un número mayor a 0 y se generarán párrafos con asteriscos.</p>

  <form method="POST">
    <input type="number" name="numero" min="1" placeholder="Introduce un número" required />
    <button type="submit">Generar Párrafos</button>
  </form>

  <div class="output">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $number = intval($_POST['number']); // Obtener el número ingresado
        if ($number > 0) {
            for ($i = 1; $i <= $number; $i++) {
                echo "<p>" . str_repeat("*", $i) . "</p>";
            }
        } else {
            echo "<p>Por favor, introduce un número mayor a 0.</p>";
        }
    }
    ?>
  </div>
</body>
</html>
