<?php
// Array de tweets
$tweets = [
    "¡Hola, mundo! Este es mi primer tweet. 🚀",
    "Aprendiendo PHP es más fácil con ejemplos prácticos. 💻",
    "¿Sabías que PHP 8 introduce muchas características interesantes? 🤓",
    "¡Comparte este tweet si también te gusta programar! 👍",
];

// Función para generar el HTML de un tweet
function generarHTMLTweet($texto)
{
    return "
    <div class='tweet'>
        <p>$texto</p>
    </div>
    ";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tweets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .tweet {
            border-bottom: 1px solid #e1e8ed;
            padding: 15px 0;
        }
        .tweet:last-child {
            border-bottom: none;
        }
        .tweet p {
            margin: 0;
            color: #14171a;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mis Tweets</h1>
        <?php
        // Recorrer el array de tweets y mostrar cada uno con la función
        foreach ($tweets as $tweet) {
            echo generarHTMLTweet($tweet);
        }
        ?>
    </div>
</body>
</html>
