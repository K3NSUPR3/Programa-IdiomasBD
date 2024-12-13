<?php
include 'ConexionSeq.php';

if(isset($_POST['botonInsc'])){
   $nombre=$_POST['nombre'];
   $email=$_POST['mail'];  
   $fecha=$_POST['fecha'];
   $horario=$_POST['horario'];
   $idioma=$_POST['SIdioma'];
   $Plan=$_POST['SPlan'];


    //validacion plan
    switch ($Plan) {
        case 'PB': // Plan Básico - No se permite repetir nombre ni correo
            $verificar_correo = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Correo='$email'");
            if (mysqli_num_rows($verificar_correo) > 0) {
                echo '
                    <script type="text/javascript">
                        alert("Este correo ya está registrado. Actualiza tu plan.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre'");
            if (mysqli_num_rows($verificar_usuario) > 0) {
                echo '
                    <script type="text/javascript">
                        alert("Nombre registrado. Intenta contratar otro plan.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;

        case 'PF': // Plan Familiar - Permitir hasta 3 repeticiones por idioma
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email' AND Idioma='$idioma'");
            if (mysqli_num_rows($verificar_usuario) >= 3) {
                echo '
                    <script type="text/javascript">
                        alert("Ya tienes 3 inscripciones con este plan. No puedes repetir más.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;

        case 'PV': // Plan VIP - Permitir hasta 5 repeticiones
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email'");
            if (mysqli_num_rows($verificar_usuario) >= 5) {
                echo '
                    <script type="text/javascript">
                        alert("Ya tienes 5 inscripciones con este plan. No puedes repetir más.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;
    }


    //fin valida

   //hacer el insert de datos
   $insertarDatos="INSERT INTO inscripciones(Nombre,Correo,Fecha,Horario,Idioma,Plan,Id_Insc) 
   VALUES ('$nombre','$email','$fecha','$horario','$idioma','$Plan','')";
   
   
   //Verificar que el correo no se repita en la bd
   if (mysqli_query($enlace, $insertarDatos)) {
    echo '
        <script type="text/javascript">
            alert("Inscripción exitosa.");
            window.location="service.php";
        </script>
    ';
} else {
    echo '
        <script type="text/javascript">
            alert("Error: ' . mysqli_error($enlace) . '");
        </script>
    ';
}

mysqli_close($enlace);

// if ($enlace->connect_error) { die("Conexión fallida: " . $enlace->connect_error); } 
// // Procesar el formulario cuando se envía 
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscribir"])) 
// { $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']); 
//     $email = mysqli_real_escape_string($enlace, $_POST['CorreoE']); 
//     $fecha = mysqli_real_escape_string($enlace, $_POST['Fecha']); 
//     $horario = mysqli_real_escape_string($enlace, $_POST['Horario']); 
//     $idioma = mysqli_real_escape_string($enlace, $_POST['Idioma']); 
//     $plan = mysqli_real_escape_string($enlace, $_POST['Plan']); 
//     // Determinar el monto basado en el plan
//      $monto = 0.0; if ($plan == "PB") { $monto = 490.0; } 
//      elseif ($plan == "PF") { $monto = 750.0; } 
//      elseif ($plan == "PV") { $monto = 980.0; } 
//      // Insertar los datos en la tabla inscripciones 
//      $insertarDatos = "INSERT INTO inscripciones (Nombre, Correo, Fecha, Horario, Idioma, Plan) VALUES ('$nombre', '$email', '$fecha', '$horario', '$idioma', '$plan')"; 
//      if (mysqli_query($enlace, $insertarDatos)) { // Obtener el último ID de inserción 
//         echo '<script type="text/javascript"> window.location = "service.php"; alert("Inscripción y pago realizados con éxito."); </script>';
//         $idInscripcion = mysqli_insert_id($enlace); 
//         // Insertar los datos en la tabla pago 
//         $insertarPago = "INSERT INTO pago (IDPago, IDInscripcion, Id_Solicitante, FechaPago, Idioma, Monto) VALUES (NULL, '$idInscripcion', '$nombre', '$fecha', '$idioma', '$monto')"; 
//         if (mysqli_query($enlace, $insertarPago)) { echo '<script type="text/javascript"> window.location = "service.php"; alert("Inscripción y pago realizados con éxito."); </script>'; } 
//         else { echo '<script type="text/javascript"> alert("Error al registrar el pago: ' . mysqli_error($enlace) . '"); </script>'; } 
//     } else { echo '<script type="text/javascript"> alert("Error al registrar la inscripción: ' . mysqli_error($enlace) . '"); </script>'; }
    
//     } 
//     mysqli_close($enlace);

}

?>