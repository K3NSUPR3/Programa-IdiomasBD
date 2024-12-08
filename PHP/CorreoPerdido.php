<?php
require 'Conexion_Be.php';
require 'func/FuncionCorreo.php';

$errors=array () ;

        if (!empty ($_POST))
        {

         $email = mysqli->real_escape_string($_POST['email']);
            

         if (!$isEmail($email)){
         $errors[]="Debe ingresar un correo Electronico Valido";
         
        
         if(emailExiste($email)){
            // verificar en el formulario
            $user_id = getValor ('ID', 'Email', $email) ;
                $user_id = getValor ('Nombre', 'Email', $email) ;

                $token = generaTokenPass ($email);

                    $url = 'localhost:3307//'.$SERVER["idiomas"] .
                    '/Log-In/cambia pass.php?user ID='.$user_id.'&token='.$token;

                    $asunto = 'Recuperar Password - Sistema de Usuarios';
                    $cuerpo = "User $nombre: <br /><br />Se ha solicitado un reinicio
                    de contrase&ntilde;a. <br/><br/>Para restaurar la
                    contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='
                    Şurl'>$url</a>";

                    if(enviarEmail($email,$nombre,$asunto,$cuerpo)){
                        echo "Hemos enviado un correo electronico a las direcion $email para
                        restablecer tu password. <br />";
                        echo "<a href='Log-In.php' >Iniciar Sesion</a>";

                    }else{
                        $errors[]="Error al enviar";

                    }

         }

        }else{
            $errors[]="No existe el correo";
        }

        }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="../CSS/ProcesoLogin.css">
    <link rel="stylesheet" href="../CSS/EstiloLogIn.scss">

    <!--favicon-->
    <link href="PRINCIPAL/img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">


    <title>Olvido su Contraseña</title>
</head>
<body>

   <!-- Formularios -->
    <div class="contenedor-formularios">

        <!-- Contenido de los Formularios -->
            <!-- Iniciar Sesion -->
            <div id="iniciar-sesion">
                <h1>Entrega</h1>
                <form  method="POST"> 
                    <div class="contenedor-input">
                        <label>
                             <span class="label-span req">Correo</span>
                        </label>
                        <input type="email" name="email" oninput="moveLabelUp(this)" required>
                    </div>
                    <input type="submit" class="button button-block" value="Enviar">
                </form>
            </div>
   <footer>
    <script src="../JS/ExcepcionesLogin.js"></script>
    <script src="../JS/DesplazarArriba.js"></script>
   </footer>
</body>
</html>
