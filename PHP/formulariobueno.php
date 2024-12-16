<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con validación PHP</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
   $nombre = $apellido = $dni = $email = $password = $confirmPassword = "";
   $nombreError = $apellidoError = $dniError = $emailError = $passwordError = $checkboxError = "";
   
   // Verificar si el formulario ha sido enviado
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Usar isset para evitar problemas si no existe la variable
       $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
       $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
       $dni = isset($_POST["dni"]) ? trim($_POST["dni"]) : "";
       $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
       $password = isset($_POST["password"]) ? $_POST["password"] : "";
       $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";
       $checkbox = isset($_POST["checkbox"]);

        // Validar nombre
        if (empty($nombre)) {
            $nombreError = "El nombre es obligatorio.";
        }

        // Validar apellido
        if (empty($apellido)) {
            $apellidoError = "El apellido es obligatorio.";
        }

        // Validar DNI
        if (!preg_match("/^[0-9]{8}[A-Z]$/", $dni)) {
            $dniError = "El DNI debe tener 8 números y una letra mayúscula.";
        } else {
            $letrasDNI = "TRWAGMYFPDXBNJZSQVHLCKE";
            $numeroDNI = substr($dni, 0, 8);
            $letraDNI = substr($dni, 8, 1);
            $letraCorrecta = $letrasDNI[$numeroDNI % 23];
            if ($letraDNI != $letraCorrecta) {
                $dniError = "La letra del DNI no es correcta.";
            }
        }

        // Validar correo electrónico
        if (empty($email)) {
            $emailError = "El correo electrónico es obligatorio.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "El correo electrónico no es válido.";
        }

        // Validar contraseña
        if (strlen($password) < 8) {
            $passwordError = "La contraseña debe tener al menos 8 caracteres.";
        } elseif ($password !== $confirmPassword) {
            $passwordError = "Las contraseñas no coinciden.";
        }

        // Validar checkbox
        if (!$checkbox) {
            $checkboxError = "Debes aceptar los términos para continuar.";
        }

        // Si no hay errores, mostrar mensaje de éxito
        if (empty($nombreError) && empty($apellidoError) && empty($dniError) && empty($emailError) && empty($passwordError) && empty($checkboxError)) {
            echo "<p>Formulario enviado correctamente.</p>";
        }
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <span class="error"><?php echo $nombreError; ?></span>
        </p>
        <p>
            <label for="apellido">Apellidos:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>">
            <span class="error"><?php echo $apellidoError; ?></span>
        </p>
        <p>
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo htmlspecialchars($dni); ?>">
            <span class="error"><?php echo $dniError; ?></span>
        </p>
        <p>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <span class="error"><?php echo $emailError; ?></span>
        </p>
        <p>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">
        </p>
        <p>
            <label for="confirmPassword">Confirmar contraseña:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <span class="error"><?php echo $passwordError; ?></span>
        </p>
        <p>
            <label>
                <input type="checkbox" name="checkbox" value="1" <?php echo isset($_POST["checkbox"]) ? "checked" : ""; ?>>
                Acepto los términos y condiciones
            </label>
            <span class="error"><?php echo $checkboxError; ?></span>
        </p>
        <p>
            <button type="submit">Enviar</button>
        </p>
    </form>
</body>
</html>
