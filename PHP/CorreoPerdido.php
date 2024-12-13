<?php
require 'Conexion_Be.php';
require 'func/FuncionCorreo.php';

$errors = array();

// if (!empty($_POST)) {
//     // Proteger contra SQL Injection
//     $email = mysqli_real_escape_string($conexion, $_POST['email']);

//     if (!isEmail($email)) {
//         $errors[] = "Debe ingresar un correo electrónico válido";
//     } else {
//         if (emailExiste($email)) {
//             // Obtener ID y Nombre del Usuario
//             $user_id = getValor('ID', 'Email', $email);
//             $nombre = getValor('Nombre', 'Email', $email);

//             // Generar Token para la Recuperación de Contraseña
//             $token = generaTokenPass($email);

//             // Crear URL de Recuperación
//             $url = 'http://localhost:3307/' . $_SERVER["SERVER_NAME"] .
//                    '/Log-In/cambia_pass.php?user_id=' . $user_id . '&token=' . $token;

//             // Crear Asunto y Cuerpo del Correo
//             $asunto = 'Recuperar Password - Sistema de Usuarios';
//             $cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio
//                        de contraseña. <br/><br/>Para restaurar la contraseña, visita la 
//                        siguiente dirección: <a href='$url'>$url</a>";

//             // Enviar Correo
//             if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
//                 echo "Hemos enviado un correo electrónico a la dirección $email para
//                       restablecer tu password. <br />";
//                 echo "<a href='Log-In.php'>Iniciar Sesión</a>";
//             } else {
//                 $errors[] = "Error al enviar el correo";
//             }
//         } else {
//             $errors[] = "No existe una cuenta con ese correo electrónico";
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/ProcesoLogin.css">
    <link rel="stylesheet" href="../CSS/EstiloLogIn.scss">
    <link href="PRINCIPAL/img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Olvido su Contraseña</title>
</head>
<body>
    <div class="contenedor-formularios">
        <div id="iniciar-sesion">
            <h1>Entrega</h1>
            <form method="POST"> 
                <div class="contenedor-input">
                    <label><span class="label-span req">Correo</span></label>
                    <input type="email" name="email" required >
                </div>
                <input type="submit" class="button button-block" value="Enviar" onclick="redirigirPagina()">
            </form>
        </div>
    </div>
    <footer>
    <script> function redirigirPagina() { alert("Funcion casi lista Profe"); window.location.href='Log-In.php'; } </script>
        <script src="../JS/ExcepcionesLogin.js"></script>
        <script src="../JS/ExcepcionesLogin.js"></script>
        <script src="../JS/DesplazarArriba.js"></script>
    </footer>
</body>
</html>
