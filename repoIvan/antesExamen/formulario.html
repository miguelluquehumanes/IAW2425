<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Formulario</title>
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .formulario{
            display: flex;
            flex-direction: column;
            margin: 1rem;
        }
        button {padding: 0.3rem;}
        textarea{resize: none;}
        input span{margin-bottom: 1rem;}
        .error{color: red; margin-bottom: 1rem;}
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="formulario">
            <label for="">*Nombre: </label>
            <input type="text" required>
            <span class="error"></span>
        </div>
        <div class="formulario">
            <label for="">*Apellido 1: </label>
            <input type="text" required>
            <span class="error"></span>
        </div>
        <div class="formulario">
            <label for="">*Apellido 2: </label>
            <input type="text" required>
            <span class="error"></span>
        </div>
        <div class="formulario">
            <label for="">*DNI: </label>
            <input type="text" required id="dni">
            <span id="errorDNI"></span>
        </div>
        <div class="formulario">
            <label for="">*Correo: </label>
            <input type="email" id="email" required>
            <span id="errorEmail"></span>
        </div>
        <div class="formulario">
            <label for="">*Contraseña: </label>
            <input type="password" name="" id="Password" required>
            <span id="password"></span>
        </div>
        <div class="formulario">
            <label for="">*Repetir contraseña: </label>
            <input type="password" name="" id="Password2" required>
            <span id="password2"></span>

        </div>
        <div class="formulario">
            <label for="">Teléfono: </label>
            <input type="text">
        </div>
        <div class="formulario">
            <label for="">Descripción: </label>
            <textarea></textarea>
        </div>
        <div class="formulario">
            <label for="">*Aceptar política de privacidad: </label>
            <input type="checkbox" name="" id="tratamientoDatos">
            <span id="aceptar"></span>
        </div>
        <div class="formulario"><button>Enviar</button></div>
    </form>
    <script>
        $(document).ready(function () {
            $("button").click(function(e){
                e.preventDefault();
                function validarDNI (dni){
                    var LetrasPosibles = 'TRWAGMYFPDXBNJZSQVHLCKET';
                    var expresionDNI = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
                    var DNI = dni.toString().toUpperCase();
                    if(!expresionDNI.test(DNI)) return false
                    DNI.replace(/^[X]/, '0').replace(/^[Y]/, '1').replace(/^[Z]/, '2');
                    var letraDNI = DNI.substr(-1);
                    var cadenaDNI = parseInt(DNI.substr(0, 8)) % 23;
                    if (LetrasPosibles.charAt(cadenaDNI) === letraDNI) return true; 
                    
                    return false;
                }
                function validarEmail(email){  
                    var expresionEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
                    if(expresionEmail.test(email))return true;

                    return false;
                }
                function validarPassword(){
                    if($("#Password").val()===$("#Password2").val()) return true;

                    return false;
                }
                $("[required]").each(function(index, element){
                    if(element.value == "")
                        $("span").eq(index).addClass("error").text("Debes rellenar este campo");
                    else
                        $("span").eq(index).text("");
                    if($("#dni").val() !== "" && !validarDNI($('#dni').val()))
                        $("#errorDNI").addClass("error").text("Debes introducir un DNI válido");
                    else
                        $("errorDNI").text("");
                    if(!validarEmail($('#email').val()))
                        $("#errorEmail").addClass("error").text("Debes introducir un correo válido");
                    else
                        $("errorEmail").text("");
                    if (!$("#tratamientoDatos").is(":checked"))
                        $("#aceptar").addClass("error").text("Debes aceptar el tratamiento de datos");
                    else
                        $("#aceptar").text("");
                    if($("#Password").val() !== "" && $("#Password2").val() !== "" && !validarPassword()){
                        $("#password").addClass("error").text("Las contraseñas deben coincidir");
                        $("#password2").addClass("error").text("Las contraseñas deben coincidir");
                    }
                });
            });
        });
    </script>
</body>
</html>