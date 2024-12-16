<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteo</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            overflow: scroll;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form{width: 50vw;}
        .formato{
            display: flex;
            flex-direction: column;
            margin: 1rem;
            width: 100%;
        }
        #botones{
            text-align: center;
        }
        #botones input{
            padding: 0.6rem;
            border-radius: 10px;
        }
        textarea{resize: none;}
        #sortear{background-color: #0EB1D2; color: white;}
        #ganadores{margin: 2rem; border: 0.5px solid black; text-align:center;}
    </style>
</head>
<body>
        <form action="sortea2.php" method="post">
            <div class="formato">
                <label for="">Lista de participantes:</label>
                <textarea name="participantes" rows="20" required></textarea>
            </div>
            <div class="formato">
                <label for="">Números de premios:</label>
                <input type="number" name="numPremios" required>
            </div>
            <div id="botones">
                <input type="submit" id="sortear" name="sortear" value="¡Sortear!">
            </div>  
        </form>
        <?php
            if(isset($_POST['sortear'])){
                if($_POST['numPremios'] > 0 && !empty(htmlspecialchars($_POST['participantes']))){
                    $cadena = htmlspecialchars($_POST['participantes']);
                    $premios = $_POST['numPremios'];
                        /*Vacio el array para evitar que se acumulen participantes*/
                        $arrayPart = [];
                        $arrayPart = explode(" ", $cadena); 
                        $agraciados = array_rand($arrayPart, $premios);
                        /*si la funcion array_rand no devuelve mas de un valore no formará un array 
                        y php dará un error de ahí el uso de if*/
                        if(is_array($agraciados)){
                            echo"<div id='ganadores'>Han ganado el premio: <br>";
                            foreach($agraciados as $seleccionado)
                                echo $arrayPart[$seleccionado] . "<br>";
                            echo"</div>";
                        }else
                            echo"<div id='ganadores'>Ha ganado el premio: " . $arrayPart[$agraciados] . "</div>";
                    
                }else
                    echo"<div>Indica al menos un premio (positivo) y un participante</div>";
            }
        ?>
</body>
</html>