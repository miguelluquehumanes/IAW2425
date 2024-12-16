<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Sorteo</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        #ordenado{
            display:flex;
            flex-direction:column;
            width:max-content;
            align-items:center;
            background-color: #CCE3DE;
            border-radius: 12px;
            box-shadow: 0px 0px 30px #2A628F;
        }
        #boton {
            width: 120px; 
            padding: 0.4rem;
        }
        #resultado,#boton,input,label{margin: 1rem;}
        
    </style>
</head>
<body>
    <form action="sorteo.php" method="post">
        <div id="ordenado">
            <label for="">¿Cuánto usuarios participarán?</label>
            <input type="text" name="participantes">
            <input type="submit" value="Enviar" name="boton" id="boton">
        </div>
    </form>
    <?php

        // Verificamos si el formulario fue enviado
        if (isset($_POST['boton'])) {
            // Comprobamos si el campo 'participantes' está vacío
            if (empty($_POST['participantes'])) {
                echo "<div id='resultado'>Introduce un número antes de enviar.</div>";
            } else {
                // Si el campo tiene un valor, generamos el número aleatorio
                $participantes = htmlspecialchars($_POST['participantes']);
                $numeroRand = rand(1, intval($participantes));
                echo "<div id='resultado'>Enhorabuena usuario $numeroRand has sido el agraciado de este sorteo.</div>";
            }
        }
    ?>
        
</body>
</html>