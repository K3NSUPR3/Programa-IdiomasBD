<?php
include 'ConexionSeq.php';

if (isset($_POST['botonInsc'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['mail'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];
    $idioma = $_POST['SIdioma'];
    $plan = $_POST['SPlan'];
    $monto = 0.0;

    // Validación del plan y cálculo del monto
    switch ($plan) {
        case 'PB': // Plan Básico
            $monto = 490.0;
            $verificar_correo = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Correo='$email'");
            if (mysqli_num_rows($verificar_correo) > 0) {
                echo '<script>alert("Este correo ya está registrado. Actualiza tu plan."); window.location="service.php";</script>';
                exit();
            }
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre'");
            if (mysqli_num_rows($verificar_usuario) > 0) {
                echo '<script>alert("Nombre registrado. Intenta contratar otro plan."); window.location="service.php";</script>';
                exit();
            }
            break;
        case 'PF': // Plan Familiar
            $monto = 750.0;
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email' AND Idioma='$idioma'");
            if (mysqli_num_rows($verificar_usuario) >= 3) {
                echo '<script>alert("Ya tienes 3 inscripciones con este plan. No puedes repetir más."); window.location="service.php";</script>';
                exit();
            }
            break;
        case 'PV': // Plan VIP
            $monto = 980.0;
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email'");
            if (mysqli_num_rows($verificar_usuario) >= 5) {
                echo '<script>alert("Ya tienes 5 inscripciones con este plan. No puedes repetir más."); window.location="service.php";</script>';
                exit();
            }
            break;
    }

    // Insertar datos en inscripciones
$insertarDatos = "INSERT INTO inscripciones (Nombre, Correo, Fecha, Horario, Idioma, Plan) 
VALUES ('$nombre', '$email', '$fecha', '$horario', '$idioma', '$plan')";

if (mysqli_query($enlace, $insertarDatos)) {
// Obtener el ID de la inscripción recién insertada
$idInscripcion = mysqli_insert_id($enlace);

// Corregir el formato de la fecha si es necesario
$fechaPago = date('Y-m-d', strtotime($fecha)); // Asegurarse de usar el formato YYYY-MM-DD

// Insertar datos en pago
$insertarPago = "INSERT INTO pago (IDInscripcion, Id_Solicitante, FechadePago, Monto, Idioma)
   VALUES ('$idInscripcion', '$nombre', '$fechaPago', '$monto', '$idioma')";

if (mysqli_query($enlace, $insertarPago)) {
echo '<script>alert("Inscripción y pago realizados con éxito."); window.location="service.php";</script>';
} else {
echo '<script>alert("Error al registrar el pago: ' . mysqli_error($enlace) . '");</script>';
}
} else {
echo '<script>alert("Error al registrar la inscripción: ' . mysqli_error($enlace) . '");</script>';
}

    mysqli_close($enlace);
}
?>
